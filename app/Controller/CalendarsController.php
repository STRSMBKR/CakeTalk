<?php
App::uses('AppController', 'Controller');
/**
 * Uploads Controller
 *
 * @property Upload $Upload
 */
class CalendarsController extends AppController {
	public $helpers = array('Html','Form');
	
function index() {

// get all the events from the database.
$calendars = $this->Calendar->find('all');

// insert rows to an array.
for ($a=0; count($calendars)> $a; $a++){

$rows[]= '{"id":'.$calendars[$a]['Calendar']['id'].', "title":"'.calendars[$a]['Calendar']['name'].'", "start":"'.$calendars[$a]['Calendar']['calendar_date'].'", "className":"'.$calendars[$a]['Calendar']['type'].'","type":"'.$calendars[$a]['Calendar']['type'].'"}';

}

// convert the array to a string.
if ($rows){
$convertojson = implode(",", $rows);
}

// pass the string to the json variable. this will then be passed  and printed to the javascript code.
$this->set('json',"[".$convertojson."]"); 

}

	
function add(){
    if (empty( $this->data)){
    } else {
        // 保存
        if ($this->Calendar->save( $this->request->data)){
            $this->Session->setFlash( '追加できました');
        } else {
            $this->Session->setFlash( '追加できませんでした');
        }
    }
}


function fcfeed(){
    // start/endをSQL用に編集
    $mysqlstart = date( 'Y-m-d H:i:s', $this->params['url']['start']);
    $mysqlend   = date( 'Y-m-d H:i:s', $this->params['url']['end']);
    // SQL
    $conditions = array( 'Calendar.start BETWEEN ? AND ?' => array( $mysqlstart, $mysqlend));
    $calendars = $this->Calendar->find( 'all', array( 'conditions' => $conditions));

    // SQLのレスポンスをもとにデータ作成
    $rows = array();
    for ( $a=0; count( $calendars) > $a; $a++) {
        $rows[] = array(
            'id' => $calendars[$a]['Calendar']['id'],
            'title' => $calendars[$a]['Calendar']['title'],
            'start' => date( 'Y-m-d H:i', strtotime($calendars[$a]['Calendar']['start'])),
            'end' => date( 'Y-m-d H:i', strtotime($calendars[$a]['Calendar']['end'])),
            'allDay' => $calendars[$a]['Calendar']['allday'],
        );
    }
    // JSONへ変換
    echo json_encode( $rows);
}
}