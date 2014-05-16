<?php
//Controller名はキャメルケースの複数形
class MyPagesController extends AppController{

	//モデルの指定（今はない状態）
	public $users = array();
	
	//レイアウトの指定(defaultの場合はなくても動作する)
	public $layout = 'default';
	
	//indexアクション
	public function index(){
	//Userデータを全て入手する。
	$userData = $this->User->find('all');
	
	
	//Viewにデータを送る。
	$this->set('userData','$userData');
	}
	}