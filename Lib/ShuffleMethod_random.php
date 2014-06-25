<?php
App::uses('ShuffleMethod', 'ShuffleSim.Lib');

class ShuffleMethod_random extends ShuffleMethod {
	public function sim() {
		$arr1 = $this->cards;
		$arr2 = array();
		
		while ( 0 < count($arr1) ) {
			$i = floor(mt_rand( 0, count($arr1) - 1));
				
			$arr2[]  = $arr1[$i];
			array_splice($arr1, $i, 1, array());
		}
		
		$this->cards = $arr2;
	}
}
?>