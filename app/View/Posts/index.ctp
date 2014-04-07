<h2>掲示板</h2>
<div id = 'mainbox' class ='clearfix'>
<?php
//$res = $this->Member->find('all');
//foreach ($members as $member)
//echo h($member['Member']['name']);
echo $this->Form->create('Post');
//echo h($data['Post']['name']);
echo $this->Form->input('title',array('style'=>'width:120px'));
echo $this->Form->input('body', array('rows'=>3,'style'=>'width:300px'));
echo $this->Form->end('Save Post');
//echo $this->Html->link('投稿',array($post['Post']['id']));

?>
<div id = 'talk' class = 'clearfix'>
<dl>

<?php foreach ($posts as $post) : ?>
<dt class = 'name'>

<?php
	//debug($post);
	//rsort($post['Post']['id']);
	echo h($post['Post']['title']); ?>
	</dt>
	<dt class = 'box'>
<?php
	
	echo h($post['Post']['body']);
?>

 

<?php 
	
	echo $this->Form->postLink('削除',array('action'=>'delete',$post['Post']['id']),
	array('confirm'=>'sure?'));
	?>
	</dt>
	

<?php endforeach; ?>
</dl>
</div>


<!--<h2>Add Post</h2>-->
<?php //echo $this->Html->link('Add post', array('controller'=>'posts','action'=>'add'));
?>
</div>