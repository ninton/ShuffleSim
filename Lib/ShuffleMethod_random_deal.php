<?php
App::uses('ShuffleMethod', 'ShuffleSim.Lib');

class ShuffleMethod_random_deal extends ShuffleMethod {
	public $defaults = array(
		'block_num' => 10,	
	);
	
	public function sim() {
		$yama = array();
		for ( $yi = 0; $yi < $this->params['block_num']; ++$yi ) {
			$yama[$yi] = array();
		}
		
		for ( $ci = 0; $ci < 52; ++$ci ) {
			$yi = mt_rand( 0, $this->params['block_num'] - 1 );
			$yama[$yi][] = $this->cards[$ci];
		}
		
		$arr = array();
		for ( $yi = 0; $yi < $this->params['block_num']; ++$yi ) {
			$arr = array_merge( $arr, $yama[$yi] );
		}
		assert( count($arr) == count($this->cards) );
		
		$arr = array_reverse($arr);
		$this->cards = $arr;
	}
}