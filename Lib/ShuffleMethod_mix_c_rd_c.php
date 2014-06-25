<?php
App::uses('ShuffleMethod'            , 'ShuffleSim.Lib');
App::uses('ShuffleMethod_cut'        , 'ShuffleSim.Lib');
App::uses('ShuffleMethod_random_deal', 'ShuffleSim.Lib');

class ShuffleMethod_mix_c_rd_c extends ShuffleMethod {
	public function sim() {
		$sim1 = new ShuffleMethod_cut();
		$sim1->cards = $this->cards;
		$sim1->sim();

		$sim2 = new ShuffleMethod_random_deal();
		$sim2->cards = $sim1->cards;
		$sim2->sim();

		$sim1->cards = $sim2->cards;
		$sim1->sim();
		
		$this->cards = $sim1->cards;
	}
}