<?php 
//echo $this->element('header');
?>
<div id = "head" class = "clearfix">
<h2>マイページ</h2>
<?php echo $this->Html->link('ログアウト',array('action' => 'logout')); ?></p>
</div>
<div id = "mainmenu" class = "clearfix">
<ul><li class = "menu"><?php echo $this->Html->link('ゼミ生一覧',array('action' => 'userlist')); ?></li>
<li class = "menu"><?php echo $this->Html->link('掲示板',array('action' => 'talk')); ?></li>
<li class = "menu"><?php echo $this->Html->link('データ共有',array('action'=>'upload'));?></li>
<li class = "menu"><?php echo $this->Html->link('スケジュール',array('action'=>'schedule'));?></li>
</ul>
</div >
