<?php
App::uses('AppController', 'Controller');
class TasksController extends AppController {
  public $name = 'Tasks';
  // ajax呼び出しに必要
  public $components = array('RequestHandler');
  // とりあえずタスクの一覧表示
  function index() {
  $this->set('tasks', $this->Task->find('all'));
  }
  // ajaxで呼び出される関数
  function ajax_add() {
    // デバッグ情報出力を抑制
    Configure::write('debug', 0);
    // ajax用のレイアウトを使用
	$this->layout = "ajax";
	//$this->autoRender = false;
	//$this->autoLayout = false;
    // ajaxによる呼び出し？
    //if($this->RequestHandler->is('ajax')) {
	if($this->RequestHandler->isAjax()) {
    // POST情報は$this->params['form']で取得
	$title = $this->request->params['form']['title'];
    // DBに突っ込みます
    $this->Task->id = null;
	$this->request->data = $title;  
	//$this->request->data['Task']['title'] = $title;
	  //$this->Task->save($this->request->data['Task']['title']);
      // 表示用のデータをviewに渡す
      $this->set('t', $title);
    }
  }
}