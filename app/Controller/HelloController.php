<?php
App::uses('AppController','Controller');
class HelloController extends AppController {
	public $helpers = array('Html', 'Form', 'Js' => array('Jquery'));
	
	public function index(){
		Configure::write('debug',0);
		}
	
	public function getAjax(){
		$this->autoRender = false;
		$this->uses = null;
		Configure::write('debug',0);
		echo '現在の日時：'.date('Y-m-d h:i:s');
		}
		}
	?>