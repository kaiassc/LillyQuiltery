<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) || strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) !== 'xmlhttprequest') {
	//header(':', true, 505);
	//die('<p style="font-size: 24px; margin: 20px 10px 20px 10px;">Please don\'t try to hurt our site... : (</p>');
}

require_once('application/controllers/api/v1/Api_V1_Controller.php');

class Api_V1_Users_Controller extends Api_V1_Controller {
	
	protected static $TABLE = 'PatternType';
	protected static $TABLE_ABBREVIATION = 'pt';

	protected static $MAX_LIMIT = 25;
	
	protected static $GET_FIELDS = array(
		'id' => array(
			'field' => 'ID',
			'type' => 'int'
		),
		'name' => array(
			'field' => 'Name',
			'type' => 'string'
		)
	);
	
	protected static $WHERE_FIELDS = array(
		'id' => array(
			'field' => 'ID',
			'type' => 'int'
		),
		'name' => array(
			'field' => 'Name',
			'type' => 'string'
		)
	);

	protected static $ORDER_BY_FIELDS = array(
		'id' => array(
			'field' => 'ID'
		),
		'name' => array(
			'field' => 'Name'
		)
	);

	protected static $PUT_FIELDS = array(
		'name' => array(
			'field' => 'Name',
			'type' => 'string'
		)
	);
	
}