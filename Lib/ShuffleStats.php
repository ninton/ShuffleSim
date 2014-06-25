<?php
class ShuffleStats {
	public $trial_num = 1;
	public $sum_arr   = array();
	public $pat_arr   = array();
	public $arr2      = array();
	public $arr3      = array();
	public $arr4      = array();
	
	public function init( $i_trial_num ) {
		$this->trial_num = $i_trial_num;

		for ( $card = 0; $card < 52; ++$card ) {
			for ( $pos = 0; $pos < 52; ++$pos ) {
				$this->sum_arr[$card][$pos] = 0;
				$this->arr2   [$card][$pos] = 0;
				$this->arr3   [$card][$pos] = 0;
				$this->arr4   [$card][$pos] = 0;
			}
		}
	}

	public function analyze( $i_cards ) {
		$card_cnt = 52;
		
		// 1. sum_arr
		foreach ( $i_cards as $pos => $card ) {
			$this->sum_arr[$card][$pos] ++;
		}

		// 2. pat_arr
		$arr[] = $i_cards[0];
		$arr[] = $i_cards[18];
		$arr[] = $i_cards[26];
		
		$pat = join('.', $arr);
		$pat = sha1($pat);
		
		if ( !isset($this->pat_arr[$pat]) ) {
			$this->pat_arr[$pat] = 0;
		}
		$this->pat_arr[$pat]++;
		
		// 3. arr2	
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

		// 4. arr3	
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

		// 5. arr4	
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

	public function shuffle_index() {
		$buf = '';
		
		$v = array2d_variance( $this->sum_arr );
		$sd = sqrt($v);
		$buf .= "sd=" . $sd . "\n";
		
		$v = array2d_variance( $this->arr2 );
		$sd = sqrt($v);
		$buf .= "i,i-1 sd=" . $sd . "\n";
		
		$v = array2d_variance( $this->arr3 );
		$sd = sqrt($v);
		$buf .= "i,i-2 sd=" . $sd . "\n";
		
		$v = array2d_variance( $this->arr4 );
		$sd = sqrt($v);
		$buf .= "i,i-3 sd=" . $sd . "\n";
		
		return $buf;
	}
	
	public function img_png() {
		$im = imagecreatetruecolor( 52, 52 );

		for ( $card = 0; $card < 52; ++$card ) {
			for ( $pos = 0; $pos < 52; ++$pos ) {
				$n = $this->sum_arr[$card][$pos];
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
}

function array_stats( $i_arr ) {
	$arr = $i_arr;
	$results['mean'] = array_sum($arr) / count($arr);
	
	sort( $arr, SORT_NUMERIC  );
	$results['min'   ] = $arr[0];
	$results['max'   ] = $arr[ count($arr) - 1 ];
	$results['median'] = $arr[ count($arr) / 2 ];
	
	$hist = array();
	foreach ( $arr as $v ) {
		if ( !isset($hist[$v]) ) {
			$hist[ $v ] = 0;
		}
		$hist[ $v ] ++;
	}
	arsort( $hist, SORT_NUMERIC );
	$v_arr = array_keys($hist);
	$results['mode'] = $v_arr[0];
	
	return $results;
}

function array2d_sum( $i_arr ) {
	$ymax = count($i_arr);
	$xmax = count($i_arr[0]);

	$sum = 0.0;
	for ( $y = 0; $y < $ymax; ++$y ) {
		$sum += array_sum( $i_arr[$y] );
	}
	
	return $sum;
}

function array2d_variance( $i_arr ) {
	$ymax = count($i_arr);
	$xmax = count($i_arr[0]);
	$m = $ymax * $xmax * 1.0;
	$sum = array2d_sum( $i_arr );
	$mean = $sum / $m;
	
	$vsum = 0.0;
	for ( $y = 0; $y < $ymax; ++$y ) {
		for ( $x = 0; $x < $xmax; ++$x ) {
			$d = $i_arr[$y][$x] - $mean;
			$vsum += ($d * $d);

		}
	}
	$v = $vsum / $m;

	return $v;
}

function array2d_edge( $i_src_arr, &$o_edge_arr ) {
	$ymax = count($i_src_arr);
	$xmax = count($i_src_arr[0]);

	$o_edge_arr = array();
	for ( $y = 1; $y < $ymax - 1; ++$y ) {
		for ( $x = 1; $x < $xmax - 1; ++$x ) {
			$lx = 0.5 * (-$i_src_arr[$y  ][$x-1] + $i_src_arr[$y  ][$x+1]);
			$ly = 0.5 * (-$i_src_arr[$y-1][$x  ] + $i_src_arr[$y+1][$x  ]);
			$e = sqrt($lx*$lx + $ly*$ly);
			$e = abs($e);
			$o_edge_arr[$y-1][$x-1] = $e;
			
			assert( !is_nan($e) );
		}

	}
}

function array2d_hist( $i_arr, &$o_hist ) {
	$ymax = count($i_arr);
	$xmax = count($i_arr[0]);
	
	$o_hist = array();
	for ( $y = 0; $y < $ymax; ++$y ) {
		for ( $x = 0; $x < $xmax; ++$x ) {
			$v = $i_arr[$y][$x];
			if ( !isset($o_hist[$v]) ) {
				$o_hist[$v] = 0;
			}
			$o_hist[$v]++;
		}
	}
}

?>