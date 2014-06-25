<?php
App::uses('ShuffleMethod'            , 'ShuffleSim.Lib');
App::uses('ShuffleMethod_cut'        , 'ShuffleSim.Lib');
App::uses('ShuffleMethod_random_deal', 'ShuffleSim.Lib');

class ShuffleMethod_mix_c_rd extends ShuffleMethod {
	public function sim() {
		$shuffleSim1 = new ShuffleMethod_cut();
		$shuffleSim1->cards = $this->cards;
		$shuffleSim1->sim();

		$shuffleSim2 = new ShuffleMethod_random_deal();
		$shuffleSim2->cards = $shuffleSim1->cards;
		$shuffleSim2->sim();

		$this->cards = $shuffleSim2->cards;
	}
}