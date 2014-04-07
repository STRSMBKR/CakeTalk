<?php
App::uses('AppModel', 'Model');
/**
 * Schedule Model
 *
 */
class Schedule extends AppModel {
	var $name = "Schedule";
/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'title';

	function findByTimes($times){
		extract($times);
		$from = date("Y-n-j H:i:s", $from_time);
		$to = date("Y-n-j H:i:s", $to_time);
		$conditions = array('or'=> array(
			array("from BETWEEN ? AND ?" => array($from, $to)),
			array("to BETWEEN ? AND ?" => array($from, $to))
			));
		$order = 'from';
		return $this->find('all',compact('conditions','order'));
		}

}
