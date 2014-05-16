<?php
App::uses('AppController', 'Controller');
/**
 * Uploads Controller
 *
 * @property Upload $Upload
 */
class UploadsController extends AppController {
	public $helpers = array('Html','Form');
	public function index() {
	//$this->request->is('post');
	//$file_name = basename($this->request->data['Upload']['file']['name']);
	//$this->set('file_name',$file_name);
	//$file = WWW_ROOT.'files'.DS.$file_name;
	//$this->set('file',$file);
	

		$this->Upload->recursive = 0;
		$this->set('uploads', $this->paginate());
	}
	
	
	public function delete($id){
	if($this->request->is('get')){
	//throw new MethodNotAllwedException();
}
	//if($this->request->is('ajax')){
	if($this->Upload->delete($id)){
	//$this->autoRender = false;
	//$this->autoLayout = false;
	//$response = array('id' => $id);
	//$this->header('Content-Type: application/json');
	//echo json_encode($response);
	//exit();
		//$this->Session->setFlash('Deleted!');
		//$this->redirect(array('action'=>'index'));
		}
		$this->redirect(array('action'=>'index'));
    
}
	


 
	public function add() {
		if ($this->request->is('post')) {
			$tmp = $this->request->data['Upload']['file']['tmp_name'];
			if(is_uploaded_file($tmp)) {
				$file_name = basename($this->request->data['Upload']['file']['name']);
				$file = WWW_ROOT.'files'.DS.$file_name;
				$this->set('file',$file);
				if(move_uploaded_file($tmp, $file)) {
					$this->Upload->create();
					$this->request->data['Upload']['file_name'] = $file_name;
					if ($this->Upload->save($this->request->data)) {
						$this->Session->setFlash(__('The upload has been saved'));
						$this->redirect(array('action' => 'index'));
					} else {
						$this->Session->setFlash(__('The upload could not be saved. Please, try again.'));
					}
				}
			}
		}
	}
 
}