<h2>掲示板</h2>
<!--<?php echo $username ? '編集':'新規追加';?>
<?php echo $username;?>-->
<div id = 'mainbox' class ='clearfix'>
<?php


/*
//$res = $this->Member->find('all');
//foreach ($members as $member)
//echo h($member['Member']['name']);
echo $this->Form->create('User');
//echo h($data['Post']['name']);
//echo $this->Form->input('username',array('style'=>'width:120px'));
echo $this->Form->input('talk', array('rows'=>3,'style'=>'width:300px'));
echo $this->Form->end('Save Post');
//echo $this->Html->link('投稿',array($post['Post']['id']));
*/
?>
<!--<div id = 'talk' class = 'clearfix'>-->
<!--<dl>-->
<div id = "area">
<?php foreach ($users as $user) : ?>
<!--<dt class = 'name'>-->

<?php
	//debug($post);
	//rsort($post['Post']['id']);
	//echo h($post['User']['title']); 
?>
	<!--</dt>
	<dt class = 'box'>-->
	

<?php
	if($user['User']['talk']){?>

<ul class ="clearfix">
<li id = "npreet">
<?php
	echo h($user['User']['data']);?>
</li>
<!--</ul>
<ul id ="tpreet" class = "clearfix">-->
<li>
<?php
		echo nl2br(h($user['User']['talk']));
	}
?>
</li>





<?php



	if($user['User']['data']==$username){
	echo $this->Form->postLink('削除',array('action'=>'delete',$user['User']['id']),
	array('confirm'=>'sure?'));
	}
	else if($user['User']['data']) {
	echo nl2br('');
	}
	?>
	<!--</dt>-->
	
</ul>
<?php endforeach; ?>

</div>
<!--</dl>-->
<div id = "TalkForm">

<?php


//$res = $this->Member->find('all');
//foreach ($members as $member)
//echo h($member['Member']['name']);
echo $this->Form->create('User');

//echo h($data['Post']['name']);
//echo $this->Form->input('username',array('style'=>'width:120px'));
//$data = array('User',array('userid'=> $id));
echo $this->Form->input('data',array('type'=>'hidden','default'=>$username));

echo $this->Form->input('talk', array('rows'=>3,'style'=>'width:500px'));

echo $this->Form->end('Save Post');
$data = array('User',array('username'=> $username));
//$this->User->set($data);


//echo $this->Html->link('投稿',array($post['Post']['id']));

?>
</div>



<!--<h2>Add Post</h2>-->
<?php //echo $this->Html->link('Add post', array('controller'=>'posts','action'=>'add'));
?>
</div>