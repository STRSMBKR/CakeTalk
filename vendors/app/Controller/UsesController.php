<?php
App::uses('AppController', 'Controller');

class UsesController extends AppController {

	public $helpers = array('Html','Form');
	public function upload(){
		if($this->Use->saveAll($this->request->data)){
			echo 'ok';
			}
}
}