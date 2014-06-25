<?php
App::uses('ShuffleSimAppModel', 'ShuffleSim.Model');
/**
 * Sim Model
 *
 */
class Sim extends ShuffleSimAppModel {
	/**
	 * Display field
	 *
	 * @var string
	 */
	public $displayField = 'shuffle_name';

	/**
	 * Validation rules
	 *
	 * @var array
	 */
	public $validate = array(
			'trial_num' => array(
					'numeric' => array(
							'rule' => array('numeric'),
							//'message' => 'Your custom message here',
							//'allowEmpty' => false,
							//'required' => false,
							//'last' => false, // Stop validation after this rule
							//'on' => 'create', // Limit validation to 'create' or 'update' operations
					),
			),
			'shuffle_name' => array(
					'notEmpty' => array(
							'rule' => array('notEmpty'),
							//'message' => 'Your custom message here',
							//'allowEmpty' => false,
							//'required' => false,
							//'last' => false, // Stop validation after this rule
							//'on' => 'create', // Limit validation to 'create' or 'update' operations
					),
			),
	);
	
//	public function beforeSave($options = array()) {
//		if ( isset($this->data[$this->alias]['result_img_png']) ) {
//			$this->data[$this->alias]['result_img_png'] = unpack('h*', $this->data[$this->alias]['result_img_png']);
//		}
//		
//		parent::beforeSave($options);
//	}
}
