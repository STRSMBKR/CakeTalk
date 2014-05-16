<?php
class CalendarComponent extends Component{
	function startup(&$controller){
		$this->Controller = $controller;
		//$this->Controller = & $controller;
	}
	
	function scopeToTimes(&$scope, $year, $month, $day){
		$time = mktime(0,0,0,$month, $day, $year);
		switch($scope){
		case 'month':
		//default:
			$firstday = mktime(0,0,0,$month,1,$year);
			$from_time = mktime(0,0,0,$month,1 - date('w', $firstday),$year);
			$from_time= $time;
			$month_time = mktime(0,0,0,$month,1 - date('w', $firstday),$year);
			//$from_time = mktime(0,0,0,date('n'),1 - date('w', $firstday), $year);
			$days = ceil((date('t',$time) + date('w', $firstday))/7)*7;
			break;
		
		case 'day':
			$from_time = $time;
			$days = 1;
			break;
		
		case 'week':
		default:
			$from_time = $time;
			$days = 7;
			$scope = 'week';
			break;
		}
		$to_time = $from_time + $days * DAY -1;
		
		return compact('from_time','to_time','month_time');
}
}