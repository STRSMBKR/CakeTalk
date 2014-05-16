<?php echo $this->Form->create(null,array('type'=>'file','action'=>'add'));?>
<!--<?php echo $this->Form->input($session->flash());?>-->
<?php e($session->flash());?>
<?php echo $this->Form->file('image');?>
<?php echo $this->Form->submit('画像を追加');?>
<?php echo $this->Form->end();?>

<h2>追加した画像</h2>
<ul>
<?php foreach($images as $image) { ?>
    <li><?php e($html->link("/images/contents/{$image['Image']['filename']}"));?></li>
<?php } ?>
</ul>