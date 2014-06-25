<?php
App::uses('Sim', 'ShuffleSim.Model');

/**
 * Sim Test Case
 *
 */
class SimTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.shuffle_navi.sim'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Sim = ClassRegistry::init('ShuffleSim.Sim');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Sim);

		parent::tearDown();
	}

}
