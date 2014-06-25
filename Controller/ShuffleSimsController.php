<?php
App::uses('ShuffleSimAppController', 'ShuffleSim.Controller');
App::uses('ShuffleSimulator'  , 'ShuffleSim.Lib');
App::uses('ShuffleStats', 'ShuffleSim.Lib');

/**
 * shuffleSims Controller
 *
 */
class ShuffleSimsController extends ShuffleSimAppController {
	
/**
 * Components
 *
 * @var array
 */

/**
 * add method
 *
 * @return void
 */
	public function _add() {
		$this->request->data['ShuffleSim']['data1'] = serialize($this->simulator->result['data']);
		$this->request->data['ShuffleSim']['img1'] = $this->simulator->result['img1'];
		$this->request->data['ShuffleSim']['img2'] = $this->simulator->result['img2'];
		$this->request->data['ShuffleSim']['img3'] = $this->simulator->result['img3'];
		$this->request->data['ShuffleSim']['img4'] = $this->simulator->result['img4'];
		$this->request->data['ShuffleSim']['shuffle_index' ] = $this->simulator->result['shuffle_index'];

		$this->ShuffleSim->create();
		if ($this->ShuffleSim->save($this->request->data)) {
			$id = $this->ShuffleSim->id;
			$this->Session->setFlash(__('The sim has been saved.'));
			return $this->redirect(array('action' => 'view', $id));
		} else {
			$this->Session->setFlash(__('The sim could not be saved. Please, try again.'));
		}
	}
	
	public function add() {
		if ($this->request->is('post')) {
			$params = array();
			$this->simulator = new ShuffleSimulator();
			$this->simulator->main( $this->request->data['ShuffleSim']['shuffle_name'], $this->request->data['ShuffleSim']['trial_num'], $params );
			
			$this->request->data['ShuffleSim']['shuffle_params'] = '';
			 
			$this->_add();
		}
	}

	public function add_cut() {
		if ($this->request->is('post')) {
			$params = array();
			$params['min_pos'   ] = $this->request->data['ShuffleSim']['min_pos'   ];
			$params['max_pos'   ] = $this->request->data['ShuffleSim']['max_pos'   ];
			$params['repeat_num'] = $this->request->data['ShuffleSim']['repeat_num'];
				
			$this->simulator = new ShuffleSimulator();
			$this->simulator->main( 'cut', $this->request->data['ShuffleSim']['trial_num'], $params );
			
			$this->request->data['ShuffleSim']['shuffle_params'] = sprintf( 'min%d_max%d_rep%d', $params['min_pos'], $params['max_pos'], $params['repeat_num'] ); 				

			$this->_add();
		}
	}

	public function add_hindu() {
		if ($this->request->is('post')) {
			$params = array();
			$params['min_pos'   ] = $this->request->data['ShuffleSim']['min_pos'   ];
			$params['max_pos'   ] = $this->request->data['ShuffleSim']['max_pos'   ];
			$params['repeat_num'] = $this->request->data['ShuffleSim']['repeat_num'];
							
			$this->simulator = new ShuffleSimulator();
			$this->simulator->main( 'hindu', $this->request->data['ShuffleSim']['trial_num'], $params );
			
			$this->request->data['ShuffleSim']['shuffle_params'] = sprintf( 'min%d_max%d_rep%d', $params['min_pos'], $params['max_pos'], $params['repeat_num'] ); 
				
			$this->_add();
		}
	}

	public function add_random_deal() {
		if ($this->request->is('post')) {
			$params = array();
			$params['block_num'] = $this->request->data['ShuffleSim']['block_num'];
			
			$this->simulator = new ShuffleSimulator();
			$this->simulator->main( 'random_deal', $this->request->data['ShuffleSim']['trial_num'], $params );
			
			$this->request->data['ShuffleSim']['shuffle_params'] = sprintf( 'b%d', $this->request->data['ShuffleSim']['block_num'] ); 
				
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
		$this->ShuffleSim->id = $id;
		if (!$this->ShuffleSim->exists()) {
			throw new NotFoundException(__('Invalid sim'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->ShuffleSim->delete()) {
			$this->Session->setFlash(__('The sim has been deleted.'));
		} else {
			$this->Session->setFlash(__('The sim could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

	public function img_png($id = null) {
		if (!$this->ShuffleSim->exists($id)) {
			throw new NotFoundException(__('Invalid sim'));
		}
		$options = array('conditions' => array('ShuffleSim.' . $this->ShuffleSim->primaryKey => $id));
		$shuffleSim = $this->ShuffleSim->find('first', $options);
		$this->set('shuffleSim', $shuffleSim);
		$this->layout = false;
		
		$field = $this->request->params['named']['field'];
		$bin = $shuffleSim['ShuffleSim'][$field];
		$size = strlen($bin);
		$fname = sprintf( '%d_%s_%s_t%s_%s.png',
			$id,
			$shuffleSim['ShuffleSim']['shuffle_name'],
			$shuffleSim['ShuffleSim']['shuffle_params'],
			$shuffleSim['ShuffleSim']['trial_num'],
			$field
		);
				
		header( 'Content-type: image/png' );
		header( "Content-length: $size" );
		header( "Content-Disposition: attachment; filename=$fname" );
		echo $bin;
		die();
	}
	
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->ShuffleSim->recursive = 0;
		$this->set('shuffleSims', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->ShuffleSim->exists($id)) {
			throw new NotFoundException(__('Invalid sim'));
		}
		$options = array('conditions' => array('ShuffleSim.' . $this->ShuffleSim->primaryKey => $id));
		$shuffleSim = $this->ShuffleSim->find('first', $options);

		$this->set('shuffleSim', $shuffleSim);
	}

}
	