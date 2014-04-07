<div class="uploads index">
<h2><?php echo __('Uploads'); ?></h2>
<?php //echo $file ? '編集':'新規追加';
?>


<!--<img src = 'gazou.jpg'>-->
<?php //echo h($file);
?>
<table cellpadding="0" cellspacing="0">
<tr>
<th><?php echo __('id'); ?></th>
<th><?php echo __('file_name'); ?></th>
<th><?php echo __('created'); ?></th>
</tr>
<?php foreach ($uploads as $upload) : ?>
<tr>
<td><?php echo h($upload['Upload']['id']); ?></td>
<?php

//echo '<img src = "'.h($upload['Upload']['file_name']).'">';
//echo h($file_name);
$a = '/files/';
$a .= ($upload['Upload']['file_name']);
$b = ($upload['Upload']['file_name']);
//echo h($a);
//$data = array($upload['Upload']['file_name']);
?>
<ul><li class = "spot"><?php echo $this->Html->image($a,array('alt'=>$b,'width'=>'100px','height'=>'100px')); ?></li></ul>
<td><?php echo $this->html->link($upload['Upload']['file_name'],$a); ?></td>
<td><?php echo h($upload['Upload']['created']); ?></td>
<td><?php echo $this->Html->link('削除', array('action' => 'delete',$upload['Upload']['id'])); ?></td>
</tr>
<?php endforeach; ?>
</table>
<?php echo $this->Html->link('戻る','http://localhost/cakephp/users'); ?>
</div><!-- index -->
 
 
 
<div class="actions">
<h3><?php echo __('Actions'); ?></h3>
<ul>
<li><?php echo $this->Html->link(__('New Upload'), array('action' => 'add')); ?></li>
</ul>
</div><!-- actions -->