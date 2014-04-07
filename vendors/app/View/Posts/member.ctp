<h2>新規登録</h2>

<?php
echo $this->Form->create('Member'/*, array('action'=>'index')*/);
echo $this->Form->input('name');
echo $this->Form->input('pass');
echo $this->Form->end('登録');
//$this->Form->Html->link('登録',array($post['Member']['name']));

?>