<?php
class ShuffleMethod {
	public $defaults = array();
	public $params;
	public $cards;
	
	public function __construct( $i_params = array() ) {
		$this->params = array_merge($this->defaults, $i_params);
	}
	
	public function sim() {
		$arr1 = $this->cards;
		$arr2 = array();
		
		while ( 0 < count($arr1) ) {
			$arr2[]  = $arr1[$i];
			array_splice($arr1, $i, 1, array());
		}
		
		$this->cards = $arr2;
	}
}