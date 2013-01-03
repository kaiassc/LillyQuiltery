<?php 

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

require_once('application/core/PageController.php');

class Login_Controller extends PageController {
	
	/* @var \Entity\TexturePack $texturePack */
	public $texturePack;

	/* @var \Error $loginError */
	public $loginError;

	/* @var \Error $registerError */
	public $registerError;
	
	
	function __construct() {
		parent::__construct();
		
		$this->load->helper('url');
	}

	public function index() {
		$userManager = $this->userManager;
		
		$formType = $this->input->post('formType');
		
		if ($formType === 'login') {
			$username = trim($this->input->post('username'));
			$password = trim($this->input->post('password'));

			if ($username && $password) {
				$userManager->loginUser($username, $password, $this->loginError);
			}
			else {
				$this->loginError = new \Error(Error::MissingParameters);
			}
		}
		else if ($formType === 'register') {
			$username = trim($this->input->post('username'));
			$password = trim($this->input->post('password'));
			$verifiedPassword = trim($this->input->post('verifiedPassword'));
			$email = trim($this->input->post('email'));
			$verifiedEmail = trim($this->input->post('verifiedEmail'));

			if ($username && $password && $verifiedPassword && $email && $verifiedEmail) {
				if ($password === $verifiedPassword) {
					if ($email === $verifiedEmail) {
						$success = $userManager->createUser($username, $password, $email, $this->registerError);
						
						if ($success) {
							$userManager->loginUser($username, $password, $this->loginError);
						}
					}
					else {
						$this->registerError = new \Error(Error::VerifiedEmailMismatch);
					}
				}
				else {
					$this->registerError = new \Error(Error::VerifiedPasswordMismatch);
				}
			}
			else {
				$this->registerError = new \Error(Error::MissingParameters);
			}
		}
				
		if ($userManager->isUserLoggedIn()) {
			redirect('/user');
		}

		$this->load->view('_HeaderView');
		$this->load->view('LoginView');
		$this->load->view('_FooterView');
	}
}