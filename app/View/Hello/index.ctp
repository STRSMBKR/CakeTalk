<?php
echo $this->Html->script('jquery', array('inline' => false));
?>

<?php
$this->Js->get('#ajax_div')->event('click',
	$this->Js->request(
	array('aciton' => 'getAjax'),
	array('async' => true , 'update' => '#res_div')
	)
	);

echo $this->Js->writeBuffer();

echo $this->Html->div(null, 'This is Ajax Result.',
	array('id' => 'res_div'));

echo $this->Form->buttom('Ajaxによる更新',
	array('id' => 'ajax_div'));
	?>