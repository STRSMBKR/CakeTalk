<?php
App::uses('AppController', 'Controller');
/**
 * Schedules Controller
 *
 */
class SchedulesController extends AppController {
	public $helpers = array('Html','Form','ScheduleTable');
	//var $helpers = array('ScheduleTable');
/**
 * Scaffold
 *
 * @var mixed
 */
	var $name = 'Schedules';
	public $scaffold;
	var $components = array('Calendar');
	
function index($scope = 'month',$year=false,$month=false,$day=false){
	if(!$year) $year = date('Y');
	if(!$month) $month = date('m');
	if(!$day) $day = date('d');
	$current = sprintf("%d/%02d/%02d", $year,$month,$day);
	
	$times = $this->Calendar->scopeToTimes($scope, $year, $month, $day);
	$schedules = $this->Schedule->findByTimes($times);
	$this->set(compact('schedules','scope','times','current'));
	/*
	function index($scope = 'month'){
	$times = $this->Calendar->scopeToTimes($scope);
	$schedules = $this->Schedule->findByTimes($times);
	$this->set(compact('schedules','scope','times'));*/
	}

}
