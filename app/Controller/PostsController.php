<?php

class PostsController extends AppController{
	//public $scaffold;
	public $components = array('RequestHandler');
	public $helpers = array('Html','Form','Js');
	
	
	public function success(){
		$this->set('posts',$this->Post->find('all'));
		}
	
	public function index(){
		/*$params = array(
			'order' => 'modified desc',
			'limit' => 2);*/
			if(!empty($this->data)){
				if($this->Post->save($this->data)){
				if($this->RequestHandler->isAjax()){
					$this->render('success','ajax');
					}
					}
					}
		$this->set('posts',$this->Post->find('all'));
		$this->set('title_for_layout','記事一覧');
		//$this->redirect(array('action'=>'index'));
		
		}
		public function view($id = null){
			$this->Post->id = $id;
			$this->set('post',$this->Post->read());
			}
			
			
public function edit($id = null){
	$this->Post->id = $id;
	if($this->request->is('get')){
		$this->request->data = $this->Post->read();
		}else{
			if($this->Post->save($this->request->data)){
				$this->Session->setFlash('success!');
				$this->redirect(array('action'=>'index'));
				}else{
					$this->Session->setFlash('failed!');
					}
					}
					}
					
					
public function getAjax(){
if($this->request->is('post')){
		if($this->Post->save($this->request->data)){

			$this->Session->setFlash('Success!');
			$this->redirect(array('action'=>'index'));
			}else{
				$this->Session->setFlash('failed!');
				}
				}
	/*if($this->request->is('ajax')){
	$this->autoRender = false;
	$success = $this->Post->save($this->request->data['Post']['msg']);
	$this->set('posts',$this->Post->find('all'));
}
	$this->uses = null;
	
	Configure::write('debug',0);
	//$pattern = $this->request->data['Post']['msg'];
	/*if(empty($pattern)){
		$pattern = "Y/m/d H:i:s";}
		echo '現在の日時:' .date($pattern);*/
		$this->redirect(array('action'=>'index'));
}

//----------------追加処理-------------------
	
public function add(){
	/*if($this->request->is('ajax')){
		$this->autoRender = false;
		
		$succeed = $this->Post->save($this->request->data);
		$message = $succeed ? '追加しました':'追加に失敗しました';
		
		$data = compact('succeed','message');
		$this->response->type('json');
		echo json_encode($data);
		exit;
		}*/
	if($this->request->is('post')){
		if($this->Post->save($this->request->data)){

			$this->Session->setFlash('Success!');
			$this->redirect(array('action'=>'index'));
			}else{
				$this->Session->setFlash('failed!');
				}
				}
	/*if($this->request->is('ajax')){
	if($this->Post->delete($id)){
	$this->autoRender = false;
	$this->autoLayout = false;
	$response = array('id' => $id);
	$this->header('Content-Type: application/json');
	echo json_encode($response);
	exit();
}
}
	$this->redirect(array('action'=>'index'));

				*/	}
				
				
//-----------------削除処理-----------------------
	public function delete($id){
			if($this->request->is('get')){
			throw new MethodNotAllException();
			}
			/*if($this->Post->delete($id)){
				$this->Session->setFlash('Deleted!');
				$this->redirect(array('action'=>'index'));

}*/
	if($this->request->is('ajax')){
	if($this->Post->delete($id)){
	$this->autoRender = false;
	$this->autoLayout = false;
	$response = array('id' => $id);
	$this->header('Content-Type: application/json');
	echo json_encode($response);
	exit();
}
}
	$this->redirect(array('action'=>'index'));
	}

}