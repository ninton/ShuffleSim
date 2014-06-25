<?php
App::uses('ShuffleMethod', 'ShuffleSim.Lib');

class ShuffleMethod_random_deal extends ShuffleMethod {
	public $defaults = array(
		'block_num' => 10,	
		'repeat_num' => 1,	
	);
	
	public function sim() {
		$ymax = $this->params['block_num'];
		
		for ( $i = 0; $i < $this->params['repeat_num']; ++$i ) {
			$yama = array();
			for ( $yi = 0; $yi < $ymax; ++$yi ) {
				$yama[$yi] = array();
			}
			
			$cnt = count($this->cards);
			$yi = 0;
			for ( $ci = 0; $ci < $cnt; ++$ci ) {
				for ( $yi = $ymax; $ymax <= $yi;  ) {
					$yi = mt_rand( 0, $ymax );
				}
				//$yi = $ci % $this->params['block_num'];
				$yama[$yi][] = $this->cards[$ci];
			}
			
			$arr = array();
			for ( $yi = 0; $yi < $ymax; ++$yi ) {
				$arr = array_merge( $arr, $yama[$yi] );
			}
			assert( count($arr) == count($this->cards) );
			
			$arr = array_reverse($arr);
			$this->cards = $arr;
		}
	}
}