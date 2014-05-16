<?php
 
class NewsController extends AppController {
    public $helpers = array('Html', 'Form');
    
    public function add() {
        if ($this->request->is('post')) {
            if ($this->Post->save($this->request->data)) {
                $this->Session->setFlash('Success!');
                $this->redirect(array('controller'=>'posts','action'=>'view',$this->data['Member']['post_id']));
            } else {
                $this->Session->setFlash('failed!');
            }
        }
    }
	}