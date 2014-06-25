<?php
App::uses('ShuffleMethod'      , 'ShuffleSim.Lib');
App::uses('ShuffleMethod_cut'  , 'ShuffleSim.Lib');
App::uses('ShuffleMethod_hindu', 'ShuffleSim.Lib');

class ShuffleMethod_mix_c_hindu_c extends ShuffleMethod {
	public function sim() {
		$sim1 = new ShuffleMethod_cut();
		$sim1->cards = $this->cards;
		$sim1->sim();

		$sim2 = new ShuffleMethod_hindu();
		$params = array(
			'min_pos' => 4,
			'max_pos' => 20,
			'repeat_num' => 5,
		);
		$sim2->cards = $sim1->cards;
		$sim2->sim( $params );

		$sim1->cards = $sim2->cards;
		$sim1->sim();

		$this->cards = $sim1->cards;
	}
}