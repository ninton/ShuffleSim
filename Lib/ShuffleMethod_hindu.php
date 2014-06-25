<?php
App::uses('ShuffleMethod', 'ShuffleSim.Lib');

class ShuffleMethod_hindu extends ShuffleMethod {
	public $defaults = array(
		'min_pos' => 4,	
		'max_pos' => 20,
		'repeat_num' => 10,	
	);
	
	public function sim() {		
		for ( $i = 0; $i < $this->params['repeat_num']; ++$i ) {
			$right = $this->cards;
			$left  = array();
			
			while ( 0 < count($right) ) {
				$pos = mt_rand( $this->params['min_pos'], $this->params['max_pos'] );
		
				$arr   = array_slice( $right, 0, $pos );
				$right = array_slice( $right, $pos );
					
				$left = array_merge( $arr, $left );
			}
		
			$this->cards = array_merge( $right, $left );
		}
	}
}