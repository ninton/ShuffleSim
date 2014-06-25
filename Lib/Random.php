<?php
class Random {
	static function normal( $i_mean = 0.0, $i_variance = 1.0 ) {
		$x = Random::normal_base();

		$y = $i_mean + $x * $i_variance;

		return $y;
	}

	static function normal_base() {
		/*
		 * mean    = 0
		* variance = 1
		*/
		$sum = 0;
		$randmax = mt_getrandmax();

		for ( $i = 0; $i < 12; ++$i ) {
			$x = mt_rand() / $randmax;
			$sum += $x;
		}
		$sum -= 6.0;

		return $sum;
	}
}
?>