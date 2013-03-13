<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) || strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) !== 'xmlhttprequest') {
	//header(':', true, 505);
	//die('<p style="font-size: 24px; margin: 20px 10px 20px 10px;">Please don\'t try to hurt our site... : (</p>');
}

require_once('application/controllers/api/v1/Api_V1_Controller.php');

class Api_V1_Patterns_Controller extends Api_V1_Controller {
	
	protected static $TABLE = 'Pattern';
	protected static $TABLE_ABBREVIATION = 'pat';
	
	protected static $MAX_LIMIT = 25;
	
	protected static $GET_FIELDS = array(
		'id' => array(
			'field' => 'ID',
			'type' => 'int'
		),
		'name' => array(
			'field' => 'Name',
			'type' => 'string'
		),
		'price' => array(
			'field' => "Price",
			"type" => 'float',
		),
		'type' => array(
			'field' => 'PatternTypeID',
			'foreignAPI' => 'PatternTypes'
		),
		
		
		/*
		'dl' => array(
			'field' => 'DownloadCount',
			'type' => 'int'
		),
		'res' => array(
			'field' => 'GameResolutionID',
			'foreignAPI' => 'Resolutions'
		),
		'ver' => array(
			'field' => 'GameVersionID',
			'foreignAPI' => 'Versions'
		),
		'mods' => array(
			'entity' => 'Entity\Modification',
			'field' => 'name',
			'foreignField' => 'supportingTexturePacks',
			'isDefault' => FALSE,
			'requiredFields' => array(
				'id'
			)
		),
		'modIDs' => array(
			'entity' => 'Entity\Modification',
			'field' => 'ID',
			'foreignField' => 'supportingTexturePacks',
			'isDefault' => FALSE,
			'requiredFields' => array(
				'id'
			)
		),*/
		'img' => array(
			'function' => 'getThumbImg',
			'requiredFields' => array(
				'id',
				'name'
			),
			'type' => 'string'
		),
		'url' => array(
			'function' => 'getURL',
			'requiredFields' => array(
				'id',
				'name'
			),
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
		),
		'type' => array(
			'field' => 'PatternTypeID',
			'type' => 'int'
		)
		
		
		/*
		'creator' => array(
			'field' => 'UserID',
			'type' => 'int'
		),
		'dl' => array(
			'field' => 'DownloadCount',
			'type' => 'int'
		),
		'res' => array(
			'field' => 'GameResolutionID',
			'type' => 'int'
		),
		'ver' => array(
			'field' => 'GameVersionID',
			'type' => 'int'
		),
		'modID' => array(
			'field' => 'supportedMods',
			'foreignField' => 'ID',
			'isPlural' => TRUE
		)*/
		
		
	);

	protected static $ORDER_BY_FIELDS = array(
		'id' => array(
			'field' => 'ID'
		),
		'name' => array(
			'field' => 'Name'
		),
		'price' => array(
			'field' => 'Price'
		),
		'date' => array(
			'field' => 'CreationDate'
		)
		
		/*
		'dl' => array(
			'field' => 'DownloadCount'
		),
		'res' => array(
			'field' => 'GameResolutionID'
		),
		'ver' => array(
			'field' => 'GameResolutionID'
		)
		*/
	);
	
	protected static $PUT_FIELDS = array(
		'name' => array(
			'field' => 'Name',
			'type' => 'string'
		),
		'type' => array(
			'field' => 'PatternID',
			'type' => 'int'
		)
		
		/*
		'dl' => array(
			'field' => 'DownloadCount',
			'type' => 'int'
		),
		'res' => array(
			'field' => 'GameResolutionID',
			'type' => 'int'
		),
		'ver' => array(
			'field' => 'GameResolutionID',
			'type' => 'int'
		)
		*/
	);
	
	public function __construct() {
		parent::__construct();
		
		$this->load->helper('url');
	}

	/** 
	 * @param Controller $controller 
	 * @param array $patternAsArray
	 */
	protected static function getThumbImg($controller, $patternAsArray) {	
		return base_url($controller->getResource()->patternBrowsableImagePathFromProperties($patternAsArray['id'], $patternAsArray['name']));
	}

	/**
	 * @param Controller $controller
	 * @param array $patternAsArray
	 */
	protected static function getURL($controller, $patternAsArray) {
		return base_url($controller->getFormat()->patternURLFromProperties($patternAsArray['id'], $patternAsArray['name']));
	}
}