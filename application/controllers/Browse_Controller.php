<?php

if (!defined('BASEPATH')) 
	exit('No direct script access allowed');

require_once('application/core/PageController.php');

class Browse_Controller extends PageController {

	public $textureDefinitions;
	
	public $selectedFilterNames;
	public $selectedOrderByName;
	
	public function index() {	
		$filters = $this->input->get('filters');
		if ($filters) {
			$this->selectedFilterNames = explode(',', $filters);
		}

		$orderBy = $this->input->get('order');
		if ($orderBy) {
			$this->selectedOrderByName = $orderBy;
		}
		
		$this->load->view('_HeaderView');
		$this->load->view('BrowseView');
		$this->load->view('_FooterView');
	}
}