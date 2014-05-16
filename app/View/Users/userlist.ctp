
<h2>ユーザ一覧</h2>
<!--<span><?php echo $this->Html->link('新規追加',array('action' => 'add')); ?></span>-->
<?php foreach($users as $user): ?>
<?php
	if($user['User']['username']){?>
<ul>
<li>
<?php echo h($user['User']['username']);?>
</li>

<?php }	?>
</ul>




<?php endforeach; ?>