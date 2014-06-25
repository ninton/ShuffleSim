<?php
class Array2dLib {
	static function edge( $i_src_arr, &$o_edge_arr ) {
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
	
	static function hist( $i_arr, &$o_hist ) {
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

	static function sum( $i_arr ) {
		$ymax = count($i_arr);
		$xmax = count($i_arr[0]);
	
		$sum = 0.0;
		for ( $y = 0; $y < $ymax; ++$y ) {
			$sum += array_sum( $i_arr[$y] );
		}
	
		return $sum;
	}
	
	static function variance( $i_arr ) {
		$ymax = count($i_arr);
		$xmax = count($i_arr[0]);
		$m = $ymax * $xmax * 1.0;
		$sum = self::sum( $i_arr );
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
	
}

?>