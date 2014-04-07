<?php
App::uses('AppController', 'Controller');

class MyFilesController extends AppController {
    function add() {			
        if (!empty($this->data) && 
             is_uploaded_file($this->data['MyFile']['File']['tmp_name'])) {
            $fileData = fread(fopen($this->data['MyFile']['File']['tmp_name'], "r"), 
                                     $this->data['MyFile']['File']['size']);
            
            $this->data['MyFile']['name'] = $this->data['MyFile']['File']['name'];
            $this->data['MyFile']['type'] = $this->data['MyFile']['File']['type'];
            $this->data['MyFile']['size'] = $this->data['MyFile']['File']['size'];
            $this->data['MyFile']['data'] = $fileData;
					
            $this->MyFile->save($this->data);

            $this->redirect('somecontroller/someaction');
        }
    }
}

// app/controllers/my_files_controller.php (Cake 1.1)
/*class MyFilesController extends AppController {
    function add() {			
        if (!empty($this->params['form']) && 
             is_uploaded_file($this->params['form']['File']['tmp_name'])) {
            $fileData = fread(fopen($this->params['form']['File']['tmp_name'], "r"), 
                                     $this->params['form']['File']['size']);
            $this->params['form']['File']['data'] = $fileData;
					
            $this->MyFile->save($this->params['form']['File']);

            $this->redirect('somecontroller/someaction');
        }
    }
}*/
?>