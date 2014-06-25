<?php
App::uses('ShuffleMethod'      , 'ShuffleSim.Lib');
App::uses('ShuffleMethod_cut'  , 'ShuffleSim.Lib');
App::uses('ShuffleMethod_hindu', 'ShuffleSim.Lib');

class ShuffleMethod_mix_c_hindu_c extends ShuffleMethod {
	public function sim() {
		$shuffleSim1 = new ShuffleMethod_cut();
		$shuffleSim1->cards = $this->cards;
		$shuffleSim1->sim();

		$shuffleSim2 = new ShuffleMethod_hindu();
		$params = array(
			'min_pos' => 4,
			'max_pos' => 20,
			'repeat_num' => 5,
		);
		$shuffleSim2->cards = $shuffleSim1->cards;
		$shuffleSim2->sim( $params );

		$shuffleSim1->cards = $shuffleSim2->cards;
		$shuffleSim1->sim();

		$this->cards = $shuffleSim1->cards;
	}
}