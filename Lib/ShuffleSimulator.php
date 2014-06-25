<?php
App::uses('ShuffleStats', 'ShuffleSim.Lib');
App::uses('Random'      , 'ShuffleSim.Lib');

class ShuffleSimulator {
	public $INITAIL_CARDS = [];
	public $cards = [];
	public $trial_num = 100;
	public $stats;
	
	public $result = array(
		'data'    => '',
		'img_png' => '',
	);
	
	public function __construct() {
		for ( $i = 0; $i < 52; ++$i ) {
			$this->INITAIL_CARDS[$i] = $i;
		}
		$this->stats = new ShuffleStats();
	}
	
	public function main ( $i_shuffle_name, $i_trial_num, $i_params ) {
		ini_set( 'max_execution_time', 3600 );
		
		$className = "ShuffleMethod_" . $i_shuffle_name;
		App::uses( $className, 'ShuffleSim.Lib' );
		$shuffleSim = new $className( $i_params );
		
		$this->trial_num = $i_trial_num;
		$this->stats->init($this->trial_num);
		
		for ( $i = 0; $i < $this->trial_num; ++$i ) {
			$shuffleSim->cards = $this->INITAIL_CARDS;
			$shuffleSim->sim();
			$this->stats->analyze( $shuffleSim->cards );
		}
		
		$this->result['data'] = $this->stats->arr1;
		$this->result['img1'] = $this->stats->img_png();	
		$this->result['img2'] = $this->stats->img_png2();	
		$this->result['img3'] = $this->stats->img_png3();	
		$this->result['img4'] = $this->stats->img_png4();	
		$this->result['shuffle_index'] = $this->stats->shuffle_index();
	}
}
?>