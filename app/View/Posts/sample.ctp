<h2>新規登録</h2>

<?php
echo $this->Form->create('new');
echo $this->Form->input('name');
echo $this->Form->input('num');
echo $this->Form->end('登録');