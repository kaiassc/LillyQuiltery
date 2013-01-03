<?php
/**
 * Created by Brad Walker on 9/25/12 at 4:05 PM
*/


if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Library {
	
	/** @var \Controller $currentController */
	protected $currentController;

	public function __construct($params = NULL) {
		$this->currentController =& get_instance();
	}
	
}
