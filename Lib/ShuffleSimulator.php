<?php
App::uses('ShuffleStats', 'ShuffleSim.Lib');
App::uses('Random'      , 'ShuffleSim.Lib');

class ShuffleSimulator {
	public $CARD_CNT     = 52;
	public $SORTED_CARDS = [];
	public $cards        = [];
	public $stats        = null;
	public $trial_num    = 1;
	
	public function __construct() {
		for ( $i = 0; $i < $this->CARD_CNT; ++$i ) {
			$this->SORTED_CARDS[$i] = $i;
		}
		$this->stats = new ShuffleStats();
	}
	
	public function main ( $i_shuffle_name, $i_trial_num, $i_params ) {
		ini_set( 'max_execution_time', 3600 );
		
		$className = "ShuffleMethod_" . $i_shuffle_name;
		App::uses( $className, 'ShuffleSim.Lib' );
		$shuffleSim = new $className( $i_params );
		
		$this->trial_num = $i_trial_num;
		$this->stats->init($this->trial_num, $this->CARD_CNT);
		
		for ( $i = 0; $i < $this->trial_num; ++$i ) {
			$shuffleSim->cards = $this->SORTED_CARDS;
			$shuffleSim->sim();
			$this->stats->analyze( $shuffleSim->cards );
		}		
	}
	
	public function result() {
		return $this->stats->result();
	}
}
?>