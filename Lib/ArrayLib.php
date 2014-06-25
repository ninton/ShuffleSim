<?php
class ArrayLib {
	static function stats( $i_arr ) {
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
}

?>