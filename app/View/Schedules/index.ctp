<div id = "schedule">
	<div class = "title"><?php __('Schedule'); ?></div>
	<div class = "navi">
		<table><tr>
		<td class= "date">
		<?php //echo(date(__('F j, Y',true), $times['from_time']));
		echo (date("Y年n月j日",date($times['from_time'])));

		?></td>
		<td class = "menu">
		<?php echo($this->scheduleTable->navi('schedules',$scope,$current));	?></td>
</tr></table></div>
	<div class = "main">
	<?php
		echo $this->Html->link(__('予定を追加',true),array('controller' => 'schedules', 'action' => 'add'));
		echo $this->scheduleTable->$scope($schedules, $times);
	?>
	</div>
	<div class = "scope">
	<ul>
		<li><?php echo $this->Html->link(__('Weekly',true), array('controller' => 'schedules', 'action' => 'index', 'id' => 'week', date('Y/m/d',$times['from_time']))); ?></li>
		<li><?php echo $this->Html->link(__('Monthly',true), array('controller' => 'schedules', 'action' => 'index', 'id' => 'month', date('Y/m/d',$times['from_time']))); ?></li>
		<li><?php echo $this->Html->link(__('Daily',true), array('controller' => 'schedules', 'action' => 'index', 'id' => 'day', date('Y/m/d',$times['from_time']))); ?></li>
	</ul>
	</div>
</div>