<div class="uploads form">

<?php echo $this->Form->create('Upload', array('action' => 'add', 'type' => 'file')); ?>
<fieldset>
<legend><?php echo __('Add Upload'); ?></legend>
<?php echo $this->Form->file('file'); ?>
</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div><!-- form -->
 
 
 
<div class="actions">
<h3><?php echo __('Actions'); ?></h3>
<ul>
<li><?php echo $this->Html->link(__('List Uploads'), array('action' => 'index'));?></li>
</ul>
</div><!-- actions -->