<?php
class ShuffleMethod {
	public $defaults = array();
	public $params;
	public $cards;
	
	public function __construct( $i_params = array() ) {
		$this->params = array_merge($this->defaults, $i_params);
	}
	
	public function sim() {
	}
}