<?php 

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

require_once('application/core/PageController.php');

class User_Controller extends PageController {

	/* @var \Doctrine $doctrine */
	public $doctrine;

	/* @var \Format $format */
	public $format;

	
	/* @var \Entity\User $user */
	public $user;
	
	
	public function __construct() {
		parent::__construct();

		$this->load->helper('url');

		$this->format = $this->getFormat();
	}
	
	public function index($userID = NULL, $usernameTitle = NULL) {
		$pdo = $this->getPDO();
		
		if (!isset($userID)) {
			if ($this->userManager->isUserLoggedIn()) {
				$myUserProfileURL = $this->format->userProfileURL($this->userManager->getLoggedInUser());

				redirect($myUserProfileURL, 'location');
			}
			else {
				redirect('login');
			}
			
			return;
		}

		$userStmt = $pdo->prepare(sprintf('SELECT %s FROM User WHERE ID = :userID',
			\Entity\User::getAllFields()
		));
		$userSuccess = $userStmt->execute(array(
			':userID' => $userID
		));

		if (!$userSuccess) {
			die(implode(' ', $userStmt->errorInfo()));
		}

		$userResults = $userStmt->fetchAll(PDO::FETCH_ASSOC);

		if (count($userResults) !== 1) {
			$error = new Error(Error::Redundancy);
			die($error->getDescription());
		}

		/** @var \Entity\User $user */
		$user = \Entity\User::buildFromArray($userResults[0]);
		
		$correctUsernameTitle = $this->format->titleForURL($user->getUsername());
		
		if (!isset($usernameTitle) || $usernameTitle != $correctUsernameTitle) {
			$correctUserProfileURL = $this->format->userProfileURL($user);
			redirect($correctUserProfileURL, 'location', 301);
		}
		
		$this->user = $user;
		
		$this->load->view('_HeaderView');
		$this->load->view('UserView');
		$this->load->view('_FooterView');
	}

}