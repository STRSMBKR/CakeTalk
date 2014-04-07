<?php 
//echo $this->element('header');
?>
<h2>TOP</h2>


<div id = "mainmenu" class = "clearfix">
<ul><li><?php echo $this->Html->link('ユーザ管理',array('action' => 'userlist')); ?></li>
<li><?php echo $this->Html->link('掲示板',array('action' => 'talk')); ?></li>
<li><?php echo $this->Html->link('データ共有',array('action'=>'upload'));?></li>
<li><?php echo $this->Html->link('スケジュール',array('action'=>'upload'));?></li>
</ul>
</div >
<?php echo $this->Html->link('ログアウト',array('action' => 'logout')); ?>