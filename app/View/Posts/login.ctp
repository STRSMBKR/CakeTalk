<h1>サンプル2</h1>
<h2>ログイン</h2>

<?php echo $this->Form->create('User'); ?>
<?php echo $this->Form->input('username'); ?>

<?php echo $this->Form->input('password'); ?>
<?php echo $this->Form->end('ログイン'); ?>