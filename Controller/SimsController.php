<?php
App::uses('ShuffleSimAppController', 'ShuffleSim.Controller');
App::uses('ShuffleSim'  , 'ShuffleSim.Lib');
App::uses('ShuffleStats', 'ShuffleSim.Lib');

/**
 * Sims Controller
 *
 */
class SimsController extends ShuffleSimAppController {
	
/**
 * Components
 *
 * @var array
 */

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Sim->recursive = 0;
		$this->set('sims', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Sim->exists($id)) {
			throw new NotFoundException(__('Invalid sim'));
		}
		$options = array('conditions' => array('Sim.' . $this->Sim->primaryKey => $id));
		$sim = $this->Sim->find('first', $options);

		$this->set('sim', $sim);
	}

	public function result_img_png($id = null) {
		if (!$this->Sim->exists($id)) {
			throw new NotFoundException(__('Invalid sim'));
		}
		$options = array('conditions' => array('Sim.' . $this->Sim->primaryKey => $id));
		$sim = $this->Sim->find('first', $options);
		$this->set('sim', $sim);
		$this->layout = false;
		
		$size = strlen($sim['Sim']['result_img_png']);
		header( 'Content-type: image/png' );
		header( "Content-length: $size");
		echo $sim['Sim']['result_img_png'];
		die();
	}
	
	public function img_png2($id = null) {
		if (!$this->Sim->exists($id)) {
			throw new NotFoundException(__('Invalid sim'));
		}
		$options = array('conditions' => array('Sim.' . $this->Sim->primaryKey => $id));
		$sim = $this->Sim->find('first', $options);
		$this->set('sim', $sim);
		$this->layout = false;
		
		$size = strlen($sim['Sim']['img_png2']);
		header( 'Content-type: image/png' );
		header( "Content-length: $size");
		echo $sim['Sim']['img_png2'];
		die();
	}
	
	public function img_png3($id = null) {
		if (!$this->Sim->exists($id)) {
			throw new NotFoundException(__('Invalid sim'));
		}
		$options = array('conditions' => array('Sim.' . $this->Sim->primaryKey => $id));
		$sim = $this->Sim->find('first', $options);
		$this->set('sim', $sim);
		$this->layout = false;
		
		$size = strlen($sim['Sim']['img_png3']);
		header( 'Content-type: image/png' );
		header( "Content-length: $size");
		echo $sim['Sim']['img_png3'];
		die();
	}
	
	public function img_png4($id = null) {
		if (!$this->Sim->exists($id)) {
			throw new NotFoundException(__('Invalid sim'));
		}
		$options = array('conditions' => array('Sim.' . $this->Sim->primaryKey => $id));
		$sim = $this->Sim->find('first', $options);
		$this->set('sim', $sim);
		$this->layout = false;
		
		$size = strlen($sim['Sim']['img_png4']);
		header( 'Content-type: image/png' );
		header( "Content-length: $size");
		echo $sim['Sim']['img_png4'];
		die();
	}
/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$params = array();
			$sim = new ShuffleSim();
			$sim->main( $this->request->data['Sim']['shuffle_name'], $this->request->data['Sim']['trial_num'], $params );
			
			$this->request->data['Sim']['shuffle_params'] = sprintf( 'b%d', $this->request->data['Sim']['block_num'] ); 
			$this->request->data['Sim']['result_data'   ] = serialize($sim->result['data']);
			$this->request->data['Sim']['result_img_png'] = $sim->result['img_png'];
			$this->request->data['Sim']['img_png2'      ] = $sim->result['img_png2'];
			$this->request->data['Sim']['img_png3'      ] = $sim->result['img_png3'];
			$this->request->data['Sim']['img_png4'      ] = $sim->result['img_png4'];
			$this->request->data['Sim']['shuffle_index' ] = $sim->result['shuffle_index'];

			$this->_add();
		}
	}

	public function _add() {
		$this->Sim->create();
		if ($this->Sim->save($this->request->data)) {
			$id = $this->Sim->id;
			$this->Session->setFlash(__('The sim has been saved.'));
			return $this->redirect(array('action' => 'view', $id));
		} else {
			$this->Session->setFlash(__('The sim could not be saved. Please, try again.'));
		}
	}
	
	public function add_random_deal() {
		if ($this->request->is('post')) {
			$params = array();
			$params['block_num'] = $this->request->data['Sim']['block_num'];
			
			$sim = new ShuffleSim();
			$sim->main( 'random_deal', $this->request->data['Sim']['trial_num'], $params );
			
			$this->request->data['Sim']['shuffle_params'] = sprintf( 'b%d', $this->request->data['Sim']['block_num'] ); 
			$this->request->data['Sim']['result_data'   ] = serialize($sim->result['data']);
			$this->request->data['Sim']['result_img_png'] = $sim->result['img_png'];
			$this->request->data['Sim']['img_png2'      ] = $sim->result['img_png2'];
			$this->request->data['Sim']['img_png3'      ] = $sim->result['img_png3'];
			$this->request->data['Sim']['img_png4'      ] = $sim->result['img_png4'];
			$this->request->data['Sim']['shuffle_index' ] = $sim->result['shuffle_index'];
				
			$this->_add();
		}
	}

	public function add_cut() {
		if ($this->request->is('post')) {
			$params = array();
			$params['min_pos'   ] = $this->request->data['Sim']['min_pos'   ];
			$params['max_pos'   ] = $this->request->data['Sim']['max_pos'   ];
			$params['repeat_num'] = $this->request->data['Sim']['repeat_num'];
				
			$sim = new ShuffleSim();
			$sim->main( 'cut', $this->request->data['Sim']['trial_num'], $params );
			
			$this->request->data['Sim']['shuffle_params'] = sprintf( 'min%d_max%d_rep%d', $params['min_pos'], $params['max_pos'], $params['repeat_num'] ); 
			$this->request->data['Sim']['result_data'   ] = serialize($sim->result['data']);
			$this->request->data['Sim']['result_img_png'] = $sim->result['img_png'];
			$this->request->data['Sim']['img_png2'      ] = $sim->result['img_png2'];
			$this->request->data['Sim']['img_png3'      ] = $sim->result['img_png3'];
			$this->request->data['Sim']['img_png4'      ] = $sim->result['img_png4'];
			$this->request->data['Sim']['shuffle_index' ] = $sim->result['shuffle_index'];
				
			$this->_add();
		}
	}

	public function add_hindu() {
		if ($this->request->is('post')) {
			$params = array();
			$params['min_pos'   ] = $this->request->data['Sim']['min_pos'   ];
			$params['max_pos'   ] = $this->request->data['Sim']['max_pos'   ];
			$params['repeat_num'] = $this->request->data['Sim']['repeat_num'];
							
			$sim = new ShuffleSim();
			$sim->main( 'hindu', $this->request->data['Sim']['trial_num'], $params );
			
			$this->request->data['Sim']['shuffle_params'] = sprintf( 'min%d_max%d_rep%d', $params['min_pos'], $params['max_pos'], $params['repeat_num'] ); 
			$this->request->data['Sim']['result_data'   ] = serialize($sim->result['data']);
			$this->request->data['Sim']['result_img_png'] = $sim->result['img_png'];
			$this->request->data['Sim']['img_png2'      ] = $sim->result['img_png2'];
			$this->request->data['Sim']['img_png3'      ] = $sim->result['img_png3'];
			$this->request->data['Sim']['img_png4'      ] = $sim->result['img_png4'];
			$this->request->data['Sim']['shuffle_index' ] = $sim->result['shuffle_index'];
				
			$this->_add();
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Sim->id = $id;
		if (!$this->Sim->exists()) {
			throw new NotFoundException(__('Invalid sim'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Sim->delete()) {
			$this->Session->setFlash(__('The sim has been deleted.'));
		} else {
			$this->Session->setFlash(__('The sim could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
	