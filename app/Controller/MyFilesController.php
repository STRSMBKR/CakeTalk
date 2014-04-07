<?php
App::uses('AppController', 'Controller');

class MyFilesController extends AppController {
	function download($id) {
    Configure::write('debug', 0);
    $file = $this->MyFile->findById($id);
		
    header('Content-type: ' . $file['MyFile']['type']);
    header('Content-length: ' . $file['MyFile']['size']); // some people reported problems with this line (see the comments), commenting out this line helped in those cases
    header('Content-Disposition: attachment; filename="'.$file['MyFile']['name'].'"');
    echo $file['MyFile']['data'];
			
    exit();
}
function add() {			
        if (!empty($this->data) && 
             is_uploaded_file($this->data['MyFile']['File']['tmp_name'])) {
            $fileData = fread(fopen($this->data['MyFile']['File']['tmp_name'], "r"), 
                                     $this->data['MyFile']['File']['size']);
            
			$this->request->data['MyFile']['name'] = $this->request->data['MyFile']['File']['name'];
            $this->request->data['MyFile']['type'] = $this->request->data['MyFile']['File']['type'];
            $this->request->data['MyFile']['size'] = $this->request->data['MyFile']['File']['size'];
            $this->request->data['MyFile']['data'] = $fileData;
					
			$this->MyFile->save($this->request->data);
			$this->set('myfiles', $this->MyFile->find('all'));

if($this->MyFile->save($this->request->data)){
		echo 'ok';
}
			$this->redirect('index');
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