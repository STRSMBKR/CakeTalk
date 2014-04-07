<?php
App::uses('AppController', 'Controller');

class PostsController extends AppController {
//----------------------------------
	/*var $name = 'Users';
	var $components = array('Auth');
	
	function beforeFilter() {
		$this->Auth->allow('sample');
		}
	function login() {
		}
	function ligout() {
		$this->Auth->logout();
		}
		
	*/
//----------------------------------
    public $helpers = array('Html', 'Form');
    
    public function index() {
        $this->set('posts', $this->Post->find('all'));
        $this->set('title_for_layout', 'talk board');
		if ($this->request->is('post')) {
            if ($this->Post->save($this->request->data)) {
                $this->Session->setFlash('Success!');
                $this->redirect(array('action'=>'index'));
            } else {
                $this->Session->setFlash('failed!');
            }
        }
    }
    
    public function view($id = null) {
        $this->Post->id = $id;
        $this->set('post', $this->Post->read());
    }
	
	public function user() {
        if ($this->request->is('post')) {
            if ($this->Member->save($this->request->data)) {
                $this->Session->setFlash('Success!');
                $this->redirect(array('action'=>'index'));
            } else {
                $this->Session->setFlash('failed!');
            }
        }
    }
    
    public function member() {
        if ($this->request->is('post')) {
            if ($this->Post->save($this->request->data)) {
                $this->Session->setFlash('Success!');
                $this->redirect(array('action'=>'index'));
            } else {
                $this->Session->setFlash('failed!');
            }
        }
    }
    
    public function edit($id = null) {
        $this->Post->id = $id;
        if ($this->request->is('get')) {
            $this->request->data = $this->Post->read();
        } else {
            if ($this->Post->save($this->request->data)) {
                $this->Session->setFlash('success!');
                $this->redirect(array('action'=>'index'));
            } else {
                $this->Session->setFlash('failed!');
            }
        }
    }
	public function delete($id){
	if($this->request->is('get')){
	throw new MethodNotAllwedException();
}
	//if($this->request->is('ajax')){
	if($this->Post->delete($id)){
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




/*  public function sample() {
    // レイアウト関係
    $this->layout = "Sample";
    $this->set("header_for_layout", "Sample Application");
    $this->set("footer_for_layout",
        "copyright by SYODA-Tuyano. 2011.");
    // post時の処理
    if ($this->request->is('member')) {
      $this->MySampleData->save($this->request->data);
    }
  }
  */

	public function sample(){
	
	//$this->Sample->id = $id;
	if($this->request->is('sample')){
	//$this->Samples->create();
	//$this->data['User']['password'] - $this->Auth->password($this->data['User']['new_password']);
		if($this->Sample->save($this->request->data)){
		$this->Session->setFlash('Success!');
		$this->redirect(array('action'=>'index'));
		}else{
		$this->Session->setFlash('failed!');
		}
	}

}
}