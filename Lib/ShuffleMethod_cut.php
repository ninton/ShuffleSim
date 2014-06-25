<?php
App::uses('ShuffleMethod', 'ShuffleSim.Lib');

class ShuffleMethod_cut extends ShuffleMethod {
	public $defaults = array(
		'min_pos' => 16,	
		'max_pos' => 36,
		'repeat_num' => 1,	
	);
	
	public function sim() {
		for ( $i = 0; $i < $this->params['repeat_num']; ++$i ) {
			$pos = mt_rand( $this->params['min_pos'], $this->params['max_pos'] );

			$arr1 = array_slice( $this->cards, 0, $pos );
			$arr2 = array_slice( $this->cards, $pos );
			$this->cards = array_merge( $arr2, $arr1 );
		}
	}
}