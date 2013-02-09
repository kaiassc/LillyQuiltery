<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

require_once('application/core/PageController.php');

class Set_Controller extends PageController {

	/* @var \Resource $resource */
	public $resource;
	
	
	/* @var \Entity\Bundle $texturePack */
	public $bundle;

	public function __construct() {
		parent::__construct();
		
		$this->load->helper('url');
		
		$this->resource = $this->getResource();
	}
	
	public function index($bundleID = NULL, $bundleTitle = NULL) {
		$pdo = $this->getPDO();

		if (isset($bundleID) && is_numeric($bundleID) && intval($bundleID) == $bundleID) {
			if ($bundleID > 0) {
				// fetch bundle

				$bundleStmt = $pdo->prepare(sprintf('SELECT %s FROM Bundle b WHERE b.ID = :id',
					\Entity\Bundle::getAllFields('b')
				));
				$bundleSuccess = $bundleStmt->execute(array(
					':id' => $bundleID
				));

				if (!$bundleSuccess) {
					die(implode(' ', $bundleStmt->errorInfo()));
				}
				
				$bundleResults = $bundleStmt->fetchAll(PDO::FETCH_ASSOC);
				
				$bundleResultCount = count($bundleResults);
				if ($bundleResultCount > 1) {
					$error = new Error(Error::Redundancy);
					die($error->getDescription());
				}
				else if ($bundleResultCount === 0) {
					show_404();
				}
				
				/* @var \Entity\Bundle $bundle */
				$bundle = \Entity\Bundle::buildFromArray($bundleResults[0]);
				
				$correctBundleTitle = $this->format->titleForURL($bundle->getName());
				
				if (!isset($bundleTitle) || $bundleTitle !== $correctBundleTitle) {
					$correctBundleTitle = $this->format->bundleURL($bundle);

					redirect($correctBundleTitle, 'location', 301);
					die();
				}
				
				$this->bundle = $bundle;
			}
		}
		else {
			show_404();
		}

		$this->load->view('_HeaderView');
		$this->load->view('SetView');
		$this->load->view('_FooterView');
	}

	public function default_() {
		$this->index(1, 'default');
	}
}