<?php
class ImagesController extends AppController {
    var $uses = array('Image');
    function index(){
        $images = $this->Image->find('all');
        $this->set(compact('images'));
    }

    /**
     * 画像を登録する
     */
    function add(){
	$limit = 1024 * 1024;
	//debug($this->data);

        // 画像の容量チェック
        if($this->data['Image']['image']['size'] > $limit){
            $this->Session->setFlash('1MB以内の画像が登録可能です。');
            $this->redirect('index');
        }
        // アップロードされた画像か
		if(!is_uploaded_file($this->data['Image']['image']['tmp_name'])){
            $this->Session->setFlash('アップロードされた画像ではありません。');
            $this->redirect('index');
        }
        // 保存
        $image = array(
            'Image' => array(
                'filename' => md5(microtime()) . '.jpg',
                'contents' => file_get_contents($this->data['Image']['image']['tmp_name']),
            )
        );
        $this->Image->save($image);
        $this->Session->setFlash('画像をアップロードしました。');
        $this->redirect('index');
    }

    function contents($filename) {
        $this->layout = false;
        $image = $this->Image->findByFilename($filename);
        if (empty($image)) {
            $this->cakeError('error404');
        }
        header('Content-type: image/jpeg');
        echo $image['Image']['contents'];
    }
}