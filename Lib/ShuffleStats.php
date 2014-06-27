<?php
App::uses('ArrayLib'  , 'ShuffleSim.Lib');
App::uses('Array2dLib', 'ShuffleSim.Lib');

class ShuffleStats {
	public $arr1 = array();
	public $arr2 = array();
	public $arr3 = array();
	public $arr4 = array();
	public $trial_num = 1;
	public $xmax = 52;
	public $ymax = 52;

	public function adjoined_rate( $i_arr2d ) {
		$sum = array();
		for ( $y = 0; $y < $this->ymax; ++$y ) {
			$sum[$y] = 0;
			for ( $x = 0; $x < $this->xmax; ++$x ) {
				$sum[$y] += $i_arr2d[$x][$y];
			}
		}
		$rate = 1.0 * ($sum[1] + $sum[51]) / $this->xmax / $this->trial_num;
		
		return $rate;
	}
	
	public function analyze( $i_cards ) {
		// 1. arr1[x軸:$card][y軸:$pos]
		foreach ( $i_cards as $pos => $card ) {
			$this->arr1[$card][$pos] ++;
		}

		// 2. arr2[x軸:$card][y軸:距離]	$card と $card-1 の距離	
		// 3. arr3[x軸:$card][y軸:距離]	$card と $card-2 の距離
		// 4. arr4[x軸:$card][y軸:距離]	$card と $card-3 の距離
		$cards2 = $cards = array_flip( $i_cards );
				
		$this->analyze_dist( -1, $cards2, $this->arr2 );
		$this->analyze_dist( -2, $cards2, $this->arr3 );
		$this->analyze_dist( -3, $cards2, $this->arr4 );
	}
	
	public function analyze_dist( $i_delta_pos, $i_cards, &$io_arr ) {
		//	ケース1
		//	シャッフル前のカード並び	0	1	2	3		
		//	シャッフル後のカード並び	1	2	3	0
		//	----------------------------------------
		//						シャッフル前		シャッフル後
		//	カード0とカード3の距離	1			1
		//	カード1とカード0の距離	1			1
		//	カード2とカード1の距離	1			1
		//	カード3とカード2の距離	1			1
		//
		//	これを次のように表す	
		//	カード番号				0	1	2	3
		//	距離					1	1	1	1

		$card_cnt = $this->xmax;
		
		for ( $i = 0; $i < count($i_cards); ++$i ) {
			$i0 = $i + $i_delta_pos;
			$i0 = ($i0 + $card_cnt) % $card_cnt;
			$pos0 = $i_cards[$i0];
			$pos1 = $i_cards[$i];
			$dist = $pos1 - $pos0;
			$dist = ($dist + $card_cnt) % $card_cnt;
				
			if ( !isset($io_arr[$i][$dist]) ) {
				$io_arr[$i][$dist] = 0;
			}
			$io_arr[$i][$dist]++;
		}
	}

	public function build_img_png( $i_arr ) {
		// $i_arr[x軸:$pos][y軸:$card] 
		$im = imagecreatetruecolor( $this->xmax, $this->ymax );

		for ( $y = 0; $y < $this->ymax; ++$y ) {
			for ( $x = 0; $x < $this->xmax; ++$x ) {
				$v = $i_arr[$x][$y];
				$gray = (int)(255 * $v / $this->trial_num);
				$gray *= 4;
				$gray = 255 - $gray;
				if ( $gray < 0 ) {
					$gray = 0;
				}

				$color = imagecolorallocate($im, $gray, $gray, $gray);
				imagesetpixel($im, $x, $y, $color);
			}
		}

		$tmpfile = tempnam(sys_get_temp_dir(), 'shu');
		imagepng($im, $tmpfile);
		imagedestroy($im);

		$png = file_get_contents($tmpfile);
		unlink($tmpfile);

		return $png;
	}
	
	public function calc_shuffle_index() {
		$arr = array();
		
		$sd1 = Array2dLib::sd( $this->arr1 );
		$arr[] = sprintf('arr1 sd=%.4f', $sd1);
		
		$sd2 = Array2dLib::sd( $this->arr2 );
		$arr[] = sprintf('arr2 sd=%.4f', $sd2);
		
		$sd3 = Array2dLib::sd( $this->arr3 );
		$arr[] = sprintf('arr3 sd=%.4f', $sd3);
		
		$sd4 = Array2dLib::sd( $this->arr4 );
		$arr[] = sprintf('arr4 sd=%.4f', $sd4);

		$adjoined_rate = $this->adjoined_rate( $this->arr2 );
		$arr[] = sprintf('adjoined rate=%.4f', $adjoined_rate);
		
		$buf = join("\n", $arr);
		return $buf;
	}
	
	public function init( $i_trial_num, $i_len ) {
		$this->trial_num = $i_trial_num;
		$this->xmax = $i_len;
		$this->ymax = $i_len;
		
		for ( $x = 0; $x < $this->xmax; ++$x ) {
			for ( $y = 0; $y < $this->ymax; ++$y ) {
				$this->arr1[$x][$y] = 0;
				$this->arr2[$x][$y] = 0;
				$this->arr3[$x][$y] = 0;
				$this->arr4[$x][$y] = 0;
			}
		}
	}

	public function serialize_data() {
		$data = array();
		$data['arr1'] = $this->arr1;
		$data['arr2'] = $this->arr2;
		$data['arr3'] = $this->arr3;
		$data['arr4'] = $this->arr4;
		
		$str = serialize( $data );
		return $str;		
	}
	
	public function result() {
		$result = array();
		$result['data'] = $this->serialize_data();
		$result['img1'] = $this->build_img_png( $this->arr1 );
		$result['img2'] = $this->build_img_png( $this->arr2 );
		$result['img3'] = $this->build_img_png( $this->arr3 );
		$result['img4'] = $this->build_img_png( $this->arr4 );
		$result['shuffle_index'] = $this->calc_shuffle_index();
		
		return $result;
	}
}

?>