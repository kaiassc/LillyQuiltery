<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) || strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) !== 'xmlhttprequest') {
	//header(':', true, 505);
	//die('<p style="font-size: 24px; margin: 20px 10px 20px 10px;">Please don\'t try to hurt our site... : (</p>');
}

require_once('application/controllers/api/v1/Api_V1_Controller.php');

class Api_V1_Users_Controller extends Api_V1_Controller {
	
	protected static $TABLE = 'User';
	protected static $TABLE_ABBREVIATION = 'u';

	protected static $MAX_LIMIT = 25;
	
	protected static $GET_FIELDS = array(
		'id' => array(
			'field' => 'ID',
			'type' => 'int'
		),
		'username' => array(
			'field' => 'Username',
			'type' => 'string'
		),
		'email' => array(
			'field' => 'Email',
			'type' => 'string'
		),
		'rank' => array(
			'field' => 'UserRankID',
			'foreignAPI' => 'Ranks'
		),
		'packLimit' => array(
			'field' => 'PackLimit',
			'type' => 'int'
		),
		'created' => array(
			'field' => 'CreationDate',
			'type' => 'string'
		)
	);
	
	protected static $WHERE_FIELDS = array(
		'id' => array(
			'field' => 'ID',
			'type' => 'int'
		),
		'username' => array(
			'field' => 'Username',
			'type' => 'string'
		),
		'email' => array(
			'field' => 'Email',
			'type' => 'string'
		),
		'rank' => array(
			'field' => 'UserRankID',
			'type' => 'int'
		)
	);

	protected static $ORDER_BY_FIELDS = array(
		'id' => array(
			'field' => 'ID'
		),
		'username' => array(
			'field' => 'Username'
		),
		'email' => array(
			'field' => 'Email'
		),
		'rank' => array(
			'field' => 'UserRankID'
		),
		'packLimit' => array(
			'field' => 'PackLimit'
		),
		'created' => array(
			'field' => 'CreationDate'
		)
	);

	protected static $PUT_FIELDS = array(
		'username' => array(
			'field' => 'Username',
			'type' => 'string'
		),
		'email' => array(
			'field' => 'Email',
			'type' => 'string'
		),
		'packLimit' => array(
			'field' => 'PackLimit',
			'type' => 'int'
		),
		'rank' => array(
			'field' => 'UserRankID',
			'type' => 'int'
		)
	);
	
}