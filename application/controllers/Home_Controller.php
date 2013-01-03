<?php 

if (!defined('BASEPATH')) 
	exit('No direct script access allowed');

require_once('application/core/PageController.php');

class Home_Controller extends PageController {

	/** @var Validate $validate */
	public $validate;
	
	public function index() {
		$this->validate = $this->getValidate();
		
		$this->load->view('_HeaderView');
		$this->load->view('HomeView');
		$this->load->view('_FooterView');
	}
}