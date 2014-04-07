<?php 
App::import(null, 'HolidayUtil', array('file' => APP.'utils'.DS.'holiday.php'));

class ScheduleTableHelper extends AppHelper {
	var $helpers = array('Html');

	function week($schedules, $times) {
		$holidays = HolidayUtil::getHolidayNames($times['from_time'], $times['to_time']);
		$out = '';
		$out = '<table class="week">';
		$out .= '<thead>';
		$out .= '<tr>';
		for($time = $times['from_time']; $time < $times['to_time']; $time +=  DAY) {
			$class_name = strftime('%a', $time);
			if(!empty($holidays[date('n',$time)][date('j',$time)])) {
				$class_name .= ' holiday';
			}
			$out .= '<td class="'.$class_name.'">';
			$out .= $this->dayLink($time);
			$out .= '</td>';
		}
		$out .= '</tr>';
		$out .= '</thead>';
		$out .= '<tbody>';
		$out .= '<tr>';
		for($time = $times['from_time']; $time < $times['to_time']; $time +=  DAY) {
			$schedule_data = '';
			$class_name = strftime('%a', $time);
			if(!empty($holidays[date('n',$time)][date('j',$time)])) {
				$schedule_data .= $holidays[date('n',$time)][date('j',$time)];
				$schedule_data .= '<br />';
				$class_name .= ' holiday';
			}
			foreach($schedules as $schedule) {
				if(date('Ymd', $time) >= date('Ymd', strtotime($schedule['Schedule']['from']))
				&& date('Ymd', $time) <= date('Ymd', strtotime($schedule['Schedule']['to']))) {
					$schedule_data .= $this->daySchedule($time, $schedule);
					$schedule_data .= '<br />';
				}
			}
			$out .= '<td class="'.$class_name.'">';
			$out .= $schedule_data;
			if(empty($schedule_data)) {
				$out .= '&nbsp;';
			}
			$out .= '</td>';
		}
		$out .= '</tr>';
		$out .= '</tbody>';
		$out .= '</table>';

		return $out;
	}

	function month($schedules, $times) {
		$holidays = HolidayUtil::getHolidayNames($times['from_time'], $times['to_time']);
		$out = '';
		$out = '<table class="month">';
		$out .= '<tbody>';
		for($time = $times['from_time']; $time < $times['to_time']; $time +=  DAY) {
			$schedule_data = '';
			$class_name = strftime('%a', $time);
			if(!empty($holidays[date('n',$time)][date('j',$time)])) {
				$schedule_data .= $holidays[date('n',$time)][date('j',$time)];
				$schedule_data .= '<br />';
				$class_name .= ' holiday';
			}
			foreach($schedules as $schedule) {
				if(date('Ymd', $time) >= date('Ymd', strtotime($schedule['Schedule']['from']))
				&& date('Ymd', $time) <= date('Ymd', strtotime($schedule['Schedule']['to']))) {
					$schedule_data .= $this->daySchedule($time, $schedule);
					$schedule_data .= '<br />';
				}
			}
			if(date('w', $time)==0) { // sun
				$out .= '<tr>';
			}
			$out .= '<td class="'.$class_name.'">';
			$out .= '<table class="day_in_month">';
			$out .= '<tr>';
			$out .= '<th>';
			$out .= $this->dayLink($time);
			$out .= '</th>';
			$out .= '</tr>';
			$out .= '<tr>';
			$out .= '<td>';
			$out .= $schedule_data;
			if(empty($schedule_data)) {
				$out .= '&nbsp;';
			}
			$out .= '</td>';
			$out .= '</tr>';
			$out .= '</table>';
			$out .= '</td>';
			if(date('w', $time)==6) { // sat
				$out .= '</tr>';
			}
		}
		$out .= '</tbody>';
		$out .= '</table>';

		return $out;
	}

	function day($schedules, $times) {
		$out = '';
		$out = '<table class="day">';
		$out .= '<thead>';
		$out .= '<tr>';
		for($time = $times['from_time']; $time < $times['to_time']; $time +=  HOUR) {
			$out .= '<th colspan="6">'.date('G',$time).'</th>';
		}
		$out .= '</tr>';
		$out .= '<tr>';
		$maxcol = ceil(($times['to_time']-$times['from_time']) / HOUR) * 6;
		for($i = 0; $i < $maxcol; $i++) {
			$out .= '<td>&nbsp;</td>';
		}
		$out .= '</tr>';
		$out .= '</thead>';
		$out .= '<tbody>';
		$out .= '<tr>';
		$schedule_data = '';
		$time = $times['from_time'];
		foreach($schedules as $schedule) {
			if(date('YmdHi', $time) < date('YmdHi', strtotime($schedule['Schedule']['from']))) {
				$schedule_data .= $this->emptyTime($time, strtotime($schedule['Schedule']['from']));
			}
			$schedule_data .= $this->timeSchedule($schedule, $times['from_time'], $times['to_time']);
			$time = strtotime($schedule['Schedule']['to']);
		}
		$out .= $schedule_data;
		if($time < $times['to_time']) {
			$out .= $this->emptyTime($time, $times['to_time']+1);
		}
		$out .= '</tr>';
		$out .= '</tbody>';
		$out .= '</table>';

		return $out;
	}

	private function daySchedule($target, $schedule) {
		$out = sprintf('%s-%s %s',
			$this->dateOrTime($target, $schedule['Schedule']['from']),
			$this->dateOrTime($target, $schedule['Schedule']['to']),
			$schedule['Schedule']['title']
		);
		$out = $this->Html->link($out, array('action'=>'edit', 'id'=>$schedule['Schedule']['id']));
		return $out;
	}
	private function dayLink($time) {
		$out = strftime('%m/%d', $time).__(strftime('(%a)', $time), true);
		$out = $this->Html->link($out, array('action'=>'index', 'id'=>'day', date('Y/m/d',$time)));
		return $out;
	}
	
	private function dateOrTime($target, $scheduleTime) {
		if(date('Ymd', $target) == date('Ymd', strtotime($scheduleTime))) {
			$out = date('G:i', strtotime($scheduleTime));
		} else {
			$out = date('m/d', strtotime($scheduleTime));
		}
		return $out;
	}
	private function emptyTime($from, $to) {
		$colspan = intval(($to - $from) / (MINUTE*10));
		$out = sprintf('<td colspan="%s" class="empty">&nbsp;</td>', $colspan);
		return $out;
	}
	private function timeSchedule($schedule, $mintime, $maxtime) {
		$from = max(strtotime($schedule['Schedule']['from']), $mintime);
		$to = min(strtotime($schedule['Schedule']['to']), $maxtime);
		$colspan = ceil(($to - $from) / (MINUTE*10));
		$out = sprintf('<td colspan="%d">', $colspan);
		$out .= sprintf('%s-%s %s',
			$this->dateOrTime($maxtime, $schedule['Schedule']['from']),
			$this->dateOrTime($maxtime, $schedule['Schedule']['to']),
			$schedule['Schedule']['title']
		);
		$out .= '</td>';
		return $out;
	}

	//***************************************************************
	// Menu Navigations 
	//***************************************************************
	function navi($controller, $scope, $current) {
		$method = $scope.'_navi';
		return $this->$method($controller, $current);
	}
	function month_navi($controller, $current) {
		$out = '<ul>';
		list($year, $month, $day) = split('/', $current);
		$out .= sprintf('<li><a href="/%s/index/month/%s">%s</a></li>',
				$controller,
				date('Y/m', mktime(0,0,0,$month-1,1,$year)),
				__('Last month', true));
		$out .= sprintf('<li><a href="/%s/index/month/%s">%s</a></li>',
				$controller,
				date('Y/m'),
				__('This month', true));
		$out .= sprintf('<li><a href="/%s/index/month/%s">%s</a></li>',
				$controller,
				date('Y/m', mktime(0,0,0,$month+1,1,$year)),
				__('Next month', true));
		$out .= '</ul>';
		return $out;
	}
	function week_navi($controller, $current) {
		$out = '<ul>';
		list($year, $month, $day) = split('/', $current);
		$out .= sprintf('<li><a href="/%s/index/week/%s">%s</a></li>',
				$controller,
				date('Y/m/d', mktime(0,0,0,$month,$day-7,$year)),
				__('Last week', true));
		$out .= sprintf('<li><a href="/%s/index/week/%s">%s</a></li>',
				$controller,
				date('Y/m/d', mktime(0,0,0,$month,$day-1,$year)),
				__('Previous day', true));
		$out .= sprintf('<li><a href="/%s/index/week/%s">%s</a></li>',
				$controller,
				date('Y/m/d'),
				__('This week', true));
		$out .= sprintf('<li><a href="/%s/index/week/%s">%s</a></li>',
				$controller,
				date('Y/m/d', mktime(0,0,0,$month,$day+1,$year)),
				__('Next day', true));
		$out .= sprintf('<li><a href="/%s/index/week/%s">%s</a></li>',
				$controller,
				date('Y/m/d', mktime(0,0,0,$month,$day+7,$year)),
				__('Next week', true));
		$out .= '</ul>';
		return $out;
	}
	function day_navi($controller, $current) {
		$out = '<ul>';
		list($year, $month, $day) = split('/', $current);
		$out .= sprintf('<li><a href="/%s/index/day/%s">%s</a></li>',
				$controller,
				date('Y/m/d', mktime(0,0,0,$month,$day-1,$year)),
				__('Previous day', true));
		$out .= sprintf('<li><a href="/%s/index/day/%s">%s</a></li>',
				$controller,
				date('Y/m/d'),
				__('Today', true));
		$out .= sprintf('<li><a href="/%s/index/day/%s">%s</a></li>',
				$controller,
				date('Y/m/d', mktime(0,0,0,$month,$day+1,$year)),
				__('Next day', true));
		$out .= '</ul>';
		return $out;
	}

}
?>
