<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

require_once('application/core/PageController.php');

class Pattern_Controller extends PageController {

	/* @var \Resource $resource */
	public $resource;


	/* @var \Entity\Pattern $pattern */
	public $pattern;

	public function __construct() {
		parent::__construct();

		$this->load->helper('url');

		$this->resource = $this->getResource();
	}

	public function index($patternID = NULL, $patternTitle = NULL) {
		$pdo = $this->getPDO();

		if (isset($patternID) && is_numeric($patternID) && intval($patternID) == $patternID) {
			if ($patternID > 0) {
				// fetch pattern

				/*
				$packStmt = $pdo->prepare(sprintf('SELECT %s,%s,%s,%s FROM TexturePack tp INNER JOIN User u ON tp.UserID = u.ID INNER JOIN GameVersion gv ON tp.GameVersionID = gv.ID INNER JOIN GameResolution gr ON tp.GameResolutionID = gr.ID WHERE tp.ID = :id',
					\Entity\TexturePack::getAllFields('tp'),
					\Entity\User::getAllFields('u', TRUE),
					\Entity\GameVersion::getAllFields('gv', TRUE),
					\Entity\GameResolution::getAllFields('gr', TRUE)
				));
				*/
				$patternStmt = $pdo->prepare(sprintf('SELECT %s FROM Pattern pat WHERE pat.ID = :id',
					\Entity\Pattern::getAllFields('pat')
				));
				$patternSuccess = $patternStmt->execute(array(
					':id' => $patternID
				));

				if (!$patternSuccess) {
					die(implode(' ', $patternStmt->errorInfo()));
				}

				$patternResults = $patternStmt->fetchAll(PDO::FETCH_ASSOC);

				$patternResultCount = count($patternResults);
				if ($patternResultCount > 1) {
					$error = new Error(Error::Redundancy);
					die($error->getDescription());
				}
				else if ($patternResultCount === 0) {
					show_404();
				}

				/* @var \Entity\Pattern $pattern */
				$pattern = \Entity\Pattern::buildFromArray($patternResults[0]);

				$correctPatternTitle = $this->format->titleForURL($pattern->getName());

				if (!isset($patternTitle) || $patternTitle !== $correctPatternTitle) {
					$correctPatternURL = $this->format->patternURL($pattern);

					redirect($correctPatternURL, 'location', 301);
					die();
				}

				$this->pattern = $pattern;
			}
		}
		else {
			show_404();
		}

		$this->load->view('_HeaderView');
		$this->load->view('PatternView');
		$this->load->view('_FooterView');
	}

	public function default_() {
		$this->index(1, 'default');
	}
}