
<?php





	echo $this->Form->create('MyFile',array('action'=> 'add','type'=>'file'));
	echo $this->Form->file('File');
	echo $this->Form->submit('Upload');
	echo $this->Form->end();
	?>
	
	
	
	