<?php
App::uses('ArrayLib'  , 'ShuffleSim.Lib');
App::uses('Array2dLib', 'ShuffleSim.Lib');

class ShuffleStats {
	public $arr1 = array();
	public $arr2 = array();
	public $arr3 = array();
	public $arr4 = array();
	public $trial_num = 1;
	
	public function analyze( $i_cards ) {
		$card_cnt = 52;
		
		// 1. arr1
		foreach ( $i_cards as $pos => $card ) {
			$this->arr1[$card][$pos] ++;
		}

		// 2. arr2	
		for ( $i = 0; $i < count($i_cards); ++$i ) {
			$i0 = $i - 1;
			$i0 = ($i0 + $card_cnt) % $card_cnt;
			$pos0 = $i_cards[$i0];
			$pos1 = $i_cards[$i];
			$dist = $pos1 - $pos0;
			$dist = ($dist + $card_cnt) % $card_cnt;
			
			if ( !isset($this->arr2[$i][$dist]) ) {
				$this->arr2[$i][$dist] = 0;
			}
			$this->arr2[$i][$dist]++;
		}

		// 3. arr3	
		for ( $i = 0; $i < count($i_cards); ++$i ) {
			$i0 = $i - 2;
			$i0 = ($i0 + $card_cnt) % $card_cnt;
			$pos0 = $i_cards[$i0];
			$pos1 = $i_cards[$i];
			$dist = $pos1 - $pos0;
			$dist = ($dist + $card_cnt) % $card_cnt;
									
			if ( !isset($this->arr3[$i][$dist]) ) {
				$this->arr3[$i][$dist] = 0;
			}
			$this->arr3[$i][$dist]++;
		}

		// 4. arr4	
		for ( $i = 0; $i < count($i_cards); ++$i ) {
			$i0 = $i - 3;
			$i0 = ($i0 + $card_cnt) % $card_cnt;
			$pos0 = $i_cards[$i0];
			$pos1 = $i_cards[$i];
			$dist = $pos1 - $pos0;
			$dist = ($dist + $card_cnt) % $card_cnt;
									
			if ( !isset($this->arr4[$i][$dist]) ) {
				$this->arr4[$i][$dist] = 0;
			}
			$this->arr4[$i][$dist]++;
		}
	}

	public function img_png() {
		$im = imagecreatetruecolor( 52, 52 );

		for ( $card = 0; $card < 52; ++$card ) {
			for ( $pos = 0; $pos < 52; ++$pos ) {
				$n = $this->arr1[$card][$pos];
				$gray = (int)(255 * $n / $this->trial_num);
				$gray *= 4;
				$gray = 255 - $gray;
				if ( $gray < 0 ) {
					$gray = 0;
				}

				$color = imagecolorallocate($im, $gray, $gray, $gray);
				imagesetpixel($im, $card, $pos, $color);
			}
		}

		$tmpfile = tempnam(sys_get_temp_dir(), 'shu');
		imagepng($im, $tmpfile);
		imagedestroy($im);

		$png = file_get_contents($tmpfile);
		unlink($tmpfile);

		return $png;
	}
	
	public function img_png2() {
		$im = imagecreatetruecolor( 52, 52 );

		for ( $card = 0; $card < 52; ++$card ) {
			for ( $pos = 0; $pos < 52; ++$pos ) {
				$n = $this->arr2[$card][$pos];
				$gray = (int)(255 * $n / $this->trial_num);
				$gray *= 4;
				$gray = 255 - $gray;
				if ( $gray < 0 ) {
					$gray = 0;
				}

				$color = imagecolorallocate($im, $gray, $gray, $gray);
				imagesetpixel($im, $card, $pos, $color);
			}
		}

		$tmpfile = tempnam(sys_get_temp_dir(), 'shu');
		imagepng($im, $tmpfile);
		imagedestroy($im);

		$png = file_get_contents($tmpfile);
		unlink($tmpfile);

		return $png;
	}

	public function img_png3() {
		$im = imagecreatetruecolor( 52, 52 );

		for ( $card = 0; $card < 52; ++$card ) {
			for ( $pos = 0; $pos < 52; ++$pos ) {
				$n = $this->arr3[$card][$pos];
				$gray = (int)(255 * $n / $this->trial_num);
				$gray *= 4;
				$gray = 255 - $gray;
				if ( $gray < 0 ) {
					$gray = 0;
				}

				$color = imagecolorallocate($im, $gray, $gray, $gray);
				imagesetpixel($im, $card, $pos, $color);
			}
		}

		$tmpfile = tempnam(sys_get_temp_dir(), 'shu');
		imagepng($im, $tmpfile);
		imagedestroy($im);

		$png = file_get_contents($tmpfile);
		unlink($tmpfile);

		return $png;
	}

	public function img_png4() {
		$im = imagecreatetruecolor( 52, 52 );

		for ( $card = 0; $card < 52; ++$card ) {
			for ( $pos = 0; $pos < 52; ++$pos ) {
				$n = $this->arr4[$card][$pos];
				$gray = (int)(255 * $n / $this->trial_num);
				$gray *= 4;
				$gray = 255 - $gray;
				if ( $gray < 0 ) {
					$gray = 0;
				}

				$color = imagecolorallocate($im, $gray, $gray, $gray);
				imagesetpixel($im, $card, $pos, $color);
			}
		}

		$tmpfile = tempnam(sys_get_temp_dir(), 'shu');
		imagepng($im, $tmpfile);
		imagedestroy($im);

		$png = file_get_contents($tmpfile);
		unlink($tmpfile);

		return $png;
	}

	public function init( $i_trial_num ) {
		$this->trial_num = $i_trial_num;

		for ( $card = 0; $card < 52; ++$card ) {
			for ( $pos = 0; $pos < 52; ++$pos ) {
				$this->arr1[$card][$pos] = 0;
				$this->arr2[$card][$pos] = 0;
				$this->arr3[$card][$pos] = 0;
				$this->arr4[$card][$pos] = 0;
			}
		}
	}

	public function shuffle_index() {
		$buf = '';
		
		$v = Array2dLib::variance( $this->arr1 );
		$sd = sqrt($v);
		$buf .= "sd=" . $sd . "\n";
		
		$v = Array2dLib::variance( $this->arr2 );
		$sd = sqrt($v);
		$buf .= "i,i-1 sd=" . $sd . "\n";
		
		$v = Array2dLib::variance( $this->arr3 );
		$sd = sqrt($v);
		$buf .= "i,i-2 sd=" . $sd . "\n";
		
		$v = Array2dLib::variance( $this->arr4 );
		$sd = sqrt($v);
		$buf .= "i,i-3 sd=" . $sd . "\n";
		
		return $buf;
	}
	
}

?>