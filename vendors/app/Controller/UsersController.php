<?php
App::uses('AppController', 'Controller');

class UsersController extends AppController {

	public $helpers = array('Html','Form');
//コンポーネントの設定
	public $components = array(
		//Authコンポーネントの使用
		'Auth' => array(
		'authenticate' => array(
		'all' => array(
			'fields' => array(
				'username' => 'username',
				'password' => 'password',
				),
			),
			'Form',
			),
			),
			//セッションコンポーネントの使用
			'Session',
			);

	public function beforeFilter(){
	    
    // [現在ログイン中のユーザ情報]
    // Authコンポーネントのメソッドを使えば簡単
    /*debug(
        __('Anyone was Logged', true) .' = '. $this->Auth->isAuthorized(). ', '.
        __('Logged User Id', true) .' = '. $this->Auth->user('id'). ', '.
        __('Logged User Name', true) .' = '. $this->Auth->user('username')
);
*/
// Userモデルで管理されるDBのフィールド名が $this->Auth->user() の引数
    
    //ログイン後にリダイレクトするURL
    //$this->Auth->loginRedirect = '/users/index';
    
    // index と add メソッドはログイン不要
//$this->Auth->allow('index', 'add');
	//ログインなしでアクセス可能なページを列挙
	$this->Auth->allow('login','add');
	//$this->set('userSession', $this->Auth->user());
	}
	public function register(){
		if($this->request->is('post') && $this->User->save($this->request->data)){
			$this->Auth->login();
			$this->redirect('index');
			}
			}
	//--------ログイン処理------------
	public function login(){
	//フォームに入力があった場合にログイン処理後ダッシュボードへ
	if($this->request->isPost()){
		if($this->Auth->login()){
			$this->redirect(array('action' => 'index'));
}
			}
				}
	//---------ログアウト処理-----------
	public function logout(){
		$this->Auth->logout();
		//$this->redirect('login');
		}
	
	//---------ダッシュボード-----------
	public function index(){
	//ビューテンプレートを表示するのみ
	}
	
	//-------ユーザリスト---------
	public function userlist(){
	 $this->set('users', $this->User->find('all'));
	//ページネーション機能でデータを入手し、リスト作成
	$userData = $this->paginate();
	$this->set(compact('userData'));
	}
	
	
	//---------掲示板---------------
	    public function talk($id = null) {
		$this->set('username',$this->Auth->user('username'));
		$data = array('User',array('username'=> $id));
$fields = array('username');
$this->User->save($data,false,$fields);
        $this->set('users', $this->User->find('all'));
        $this->set('title_for_layout', 'talk board');
		if ($this->request->is('post')) {
            if ($this->User->save($this->request->data)) {
               // $this->Session->setFlash('Success!');
                $this->redirect(array('action'=>'talk'));
            } else {
                $this->Session->setFlash('failed!');
            }
        }
    }
	//--------投稿削除-------------
		public function delete($id){
	if($this->request->is('get')){
	throw new MethodNotAllwedException();
}
	//if($this->request->is('ajax')){
	if($this->User->delete($id)){
	//$this->autoRender = false;
	//$this->autoLayout = false;
	//$response = array('id' => $id);
	//$this->header('Content-Type: application/json');
	//echo json_encode($response);
	//exit();
		//$this->Session->setFlash('Deleted!');
		//$this->redirect(array('action'=>'index'));
		}
		$this->redirect(array('action'=>'talk'));
    
}
	
	
	//--------ユーザ詳細------------
	public function view($id){
	
		//ユーザを探して見つかったら表示
		$userData = $this->User->findById($id);
		if(empty($userData)){
			$this->Session->setFlash('ユーザが見つかりませんでした。');
			$this->redirect(array('action' => 'userlist'));
			}
			
		$this->set(compact('userData'));
		}
		
	//---------画像アップロード---------
	/*public function upload()
	{

	if($this->request->data){
		if($this->User->saveAll($this->request->data)){
		echo 'ok';
		}
		}
		}*/
//-------------画像アップロード------------
	public function upload() {	
	$this->redirect('http://localhost/cakephp/uploads');
        /*$this->set('users', $this->User->find('all'));
        $this->set('title_for_layout', 'talk board');
		if ($this->request->is('post')) {
            if ($this->User->save($this->request->data)) {
               // $this->Session->setFlash('Success!');
                $this->redirect(array('action'=>'upload'));
            } else {
                $this->Session->setFlash('failed!');
            }
        }
    }	*/	
        if (!empty($this->data) && 
             is_uploaded_file($this->data['User']['File']['tmp_name'])) {
            $fileData = fread(fopen($this->data['User']['File']['tmp_name'], "r"), 
                                     $this->data['User']['File']['size']);
            
			$this->request->data['User']['name'] = $this->request->data['User']['File']['name'];
            $this->request->data['User']['type'] = $this->request->data['User']['File']['type'];
            $this->request->data['User']['size'] = $this->request->data['User']['File']['size'];
            $this->request->data['User']['image'] = $fileData;
					
			$this->User->saveAll($this->request->data);
			$this->set('users', $this->User->find('all'));

if($this->User->save($this->request->data)){
		echo 'ok';
}
			$this->redirect('upload');
        }
    }



	
	
	//---------ユーザ追加--------------
	public function add(){
		//addはeditと同じ処理。ただしidは無指定
		return $this->edit();
		}
	public function edit($id = null){

//フォーム入力があった場合には保存処理。そうでない場合は初期値の準備
	if($this->request->isPost()||$this->request->isPut()){
	
	//edit時にもしパスワードが空白だったら対象外にする
	if($id !== null){
	if($this->request->data[$this->User->alias]['password'] == ''){
		unset($this->request->data[$this->User->alias]['password']);
		}
		}
		
		if($this->User->save($this->request->data)){
			$this->Session->setFlash('ユーザ情報を保存しました。');
			$this->redirect(array('action' => 'userlist'));
			}else{
				$this->Session->setFlash('入力に間違いがあります。');
				}
				}else{
		if($id !== null){
	$this->request->data = $this->User->findById($id);
	unset($this->request->data[$this->User->alias]['password']);
	
	if(empty($this->request->data)){
		$this->Session->setFlash('ユーザが見つかりませんでした。');
		$this->redirect(array('action' => 'userlist'));
		}
		}


}
	//addもeditもedit.ctpを表示する(明示)
	$this->render('edit');

}

}
?>