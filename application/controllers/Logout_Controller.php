<?php 

if (!defined('BASEPATH')) 
	exit('No direct script access allowed');

require_once('application/core/PageController.php');

class Logout_Controller extends PageController {
	
	function __construct() {
		parent::__construct();
		
		$this->load->helper('url');
	}

	public function index() {
		$this->userManager->logoutUser();

		redirect('/home');
	}
}