<h2>データ共有</h2>

<!--<?php foreach ($users as $user) : ?>-->
<?php
	if($user['User']['name']){?>

<?php	echo h($users['User']['name']);?>

<?php
		echo nl2br(h($users['User']['talk']));
	}
?>

<?php
	echo $this->Html->link('運用マニュアル','/files/i.pdf');
?>
<!--<?php endforeach; ?>-->

<?php
	echo $this->Form->create('User',array('action'=> 'upload','type'=>'file'));
	echo $this->Form->file('File');
	echo $this->Form->submit('Upload');
	echo $this->Form->end();
	?>
