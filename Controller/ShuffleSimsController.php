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

	public function result_img_png($id = null) {
		if (!$this->ShuffleSim->exists($id)) {
			throw new NotFoundException(__('Invalid sim'));
		}
		$options = array('conditions' => array('ShuffleSim.' . $this->ShuffleSim->primaryKey => $id));
		$shuffleSim = $this->ShuffleSim->find('first', $options);
		$this->set('shuffleSim', $shuffleSim);
		$this->layout = false;
		
		$size = strlen($shuffleSim['ShuffleSim']['result_img_png']);
		header( 'Content-type: image/png' );
		header( "Content-length: $size");
		echo $shuffleSim['ShuffleSim']['result_img_png'];
		die();
	}
	
	public function img_png2($id = null) {
		if (!$this->ShuffleSim->exists($id)) {
			throw new NotFoundException(__('Invalid sim'));
		}
		$options = array('conditions' => array('ShuffleSim.' . $this->ShuffleSim->primaryKey => $id));
		$shuffleSim = $this->ShuffleSim->find('first', $options);
		$this->set('shuffleSim', $shuffleSim);
		$this->layout = false;
		
		$size = strlen($shuffleSim['ShuffleSim']['img_png2']);
		header( 'Content-type: image/png' );
		header( "Content-length: $size");
		echo $shuffleSim['ShuffleSim']['img_png2'];
		die();
	}
	
	public function img_png3($id = null) {
		if (!$this->ShuffleSim->exists($id)) {
			throw new NotFoundException(__('Invalid sim'));
		}
		$options = array('conditions' => array('ShuffleSim.' . $this->ShuffleSim->primaryKey => $id));
		$shuffleSim = $this->ShuffleSim->find('first', $options);
		$this->set('shuffleSim', $shuffleSim);
		$this->layout = false;
		
		$size = strlen($shuffleSim['ShuffleSim']['img_png3']);
		header( 'Content-type: image/png' );
		header( "Content-length: $size");
		echo $shuffleSim['ShuffleSim']['img_png3'];
		die();
	}
	
	public function img_png4($id = null) {
		if (!$this->ShuffleSim->exists($id)) {
			throw new NotFoundException(__('Invalid sim'));
		}
		$options = array('conditions' => array('ShuffleSim.' . $this->ShuffleSim->primaryKey => $id));
		$shuffleSim = $this->ShuffleSim->find('first', $options);
		$this->set('shuffleSim', $shuffleSim);
		$this->layout = false;
		
		$size = strlen($shuffleSim['ShuffleSim']['img_png4']);
		header( 'Content-type: image/png' );
		header( "Content-length: $size");
		echo $shuffleSim['ShuffleSim']['img_png4'];
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
			$shuffleSim = new ShuffleSimulator();
			$shuffleSim->main( $this->request->data['ShuffleSim']['shuffle_name'], $this->request->data['ShuffleSim']['trial_num'], $params );
			
			$this->request->data['ShuffleSim']['shuffle_params'] = sprintf( 'b%d', $this->request->data['ShuffleSim']['block_num'] ); 
			$this->request->data['ShuffleSim']['result_data'   ] = serialize($shuffleSim->result['data']);
			$this->request->data['ShuffleSim']['result_img_png'] = $shuffleSim->result['img_png'];
			$this->request->data['ShuffleSim']['img_png2'      ] = $shuffleSim->result['img_png2'];
			$this->request->data['ShuffleSim']['img_png3'      ] = $shuffleSim->result['img_png3'];
			$this->request->data['ShuffleSim']['img_png4'      ] = $shuffleSim->result['img_png4'];
			$this->request->data['ShuffleSim']['shuffle_index' ] = $shuffleSim->result['shuffle_index'];

			$this->_add();
		}
	}

	public function _add() {
		$this->ShuffleSim->create();
		if ($this->ShuffleSim->save($this->request->data)) {
			$id = $this->ShuffleSim->id;
			$this->Session->setFlash(__('The sim has been saved.'));
			return $this->redirect(array('action' => 'view', $id));
		} else {
			$this->Session->setFlash(__('The sim could not be saved. Please, try again.'));
		}
	}
	
	public function add_random_deal() {
		if ($this->request->is('post')) {
			$params = array();
			$params['block_num'] = $this->request->data['ShuffleSim']['block_num'];
			
			$shuffleSim = new ShuffleSimulator();
			$shuffleSim->main( 'random_deal', $this->request->data['ShuffleSim']['trial_num'], $params );
			
			$this->request->data['ShuffleSim']['shuffle_params'] = sprintf( 'b%d', $this->request->data['ShuffleSim']['block_num'] ); 
			$this->request->data['ShuffleSim']['result_data'   ] = serialize($shuffleSim->result['data']);
			$this->request->data['ShuffleSim']['result_img_png'] = $shuffleSim->result['img_png'];
			$this->request->data['ShuffleSim']['img_png2'      ] = $shuffleSim->result['img_png2'];
			$this->request->data['ShuffleSim']['img_png3'      ] = $shuffleSim->result['img_png3'];
			$this->request->data['ShuffleSim']['img_png4'      ] = $shuffleSim->result['img_png4'];
			$this->request->data['ShuffleSim']['shuffle_index' ] = $shuffleSim->result['shuffle_index'];
				
			$this->_add();
		}
	}

	public function add_cut() {
		if ($this->request->is('post')) {
			$params = array();
			$params['min_pos'   ] = $this->request->data['ShuffleSim']['min_pos'   ];
			$params['max_pos'   ] = $this->request->data['ShuffleSim']['max_pos'   ];
			$params['repeat_num'] = $this->request->data['ShuffleSim']['repeat_num'];
				
			$shuffleSim = new ShuffleSimulator();
			$shuffleSim->main( 'cut', $this->request->data['ShuffleSim']['trial_num'], $params );
			
			$this->request->data['ShuffleSim']['shuffle_params'] = sprintf( 'min%d_max%d_rep%d', $params['min_pos'], $params['max_pos'], $params['repeat_num'] ); 
			$this->request->data['ShuffleSim']['result_data'   ] = serialize($shuffleSim->result['data']);
			$this->request->data['ShuffleSim']['result_img_png'] = $shuffleSim->result['img_png'];
			$this->request->data['ShuffleSim']['img_png2'      ] = $shuffleSim->result['img_png2'];
			$this->request->data['ShuffleSim']['img_png3'      ] = $shuffleSim->result['img_png3'];
			$this->request->data['ShuffleSim']['img_png4'      ] = $shuffleSim->result['img_png4'];
			$this->request->data['ShuffleSim']['shuffle_index' ] = $shuffleSim->result['shuffle_index'];
				
			$this->_add();
		}
	}

	public function add_hindu() {
		if ($this->request->is('post')) {
			$params = array();
			$params['min_pos'   ] = $this->request->data['ShuffleSim']['min_pos'   ];
			$params['max_pos'   ] = $this->request->data['ShuffleSim']['max_pos'   ];
			$params['repeat_num'] = $this->request->data['ShuffleSim']['repeat_num'];
							
			$shuffleSim = new ShuffleSimulator();
			$shuffleSim->main( 'hindu', $this->request->data['ShuffleSim']['trial_num'], $params );
			
			$this->request->data['ShuffleSim']['shuffle_params'] = sprintf( 'min%d_max%d_rep%d', $params['min_pos'], $params['max_pos'], $params['repeat_num'] ); 
			$this->request->data['ShuffleSim']['result_data'   ] = serialize($shuffleSim->result['data']);
			$this->request->data['ShuffleSim']['result_img_png'] = $shuffleSim->result['img_png'];
			$this->request->data['ShuffleSim']['img_png2'      ] = $shuffleSim->result['img_png2'];
			$this->request->data['ShuffleSim']['img_png3'      ] = $shuffleSim->result['img_png3'];
			$this->request->data['ShuffleSim']['img_png4'      ] = $shuffleSim->result['img_png4'];
			$this->request->data['ShuffleSim']['shuffle_index' ] = $shuffleSim->result['shuffle_index'];
				
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
	}}
	