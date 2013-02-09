<?php
/**
 * Created by Brad Walker on 9/3/12 at 7:25 PM
*/

require_once('application/objects/Error.php');

class Controller extends \CI_Controller {

	
	/* @var \CI_Loader $load */
	public $load;

	/* @var \CI_Router $router */
	public $router;

	/* @var \CI_Input $input */
	public $input;


	/* @var \Resource $_resource */
	private $_resource;

	/* @var \Render $_render */
	private $_render;

	/* @var \Format $_format */
	private $_format;

	/* @var \UserManager $_userManager */
	private $_userManager;

	/* @var \Validate $_validate */
	private $_validate;

	/* @var \PDO $_pdo */
	private $_pdo;
	
	
	/* @var string $className */
	public $className;
	
	
		
	public function __construct() {
		parent::__construct();
		
		$this->className = $this->router->fetch_class();
	}


	/**
	 * @return \Resource
	 */
	public function getResource() {
		if (!isset($this->_resource)) {
			$this->load->library('Resource', NULL, 'resource');
		}
		return $this->_resource;
	}

	/**
	 * @param \Resource $obj
	 */
	public function setResource($obj) {
		$this->_resource = $obj;
	}

	/**
	 * @return \Render
	 */
	public function getRender() {
		if (!isset($this->_render)) {
			$this->load->library('Render', NULL, 'render');
		}
		return $this->_render;
	}

	/**
	 * @param \Render $obj
	 */
	public function setRender($obj) {
		$this->_render = $obj;
	}

	/**
	 * @return \Format
	 */
	public function getFormat() {
		if (!isset($this->_format)) {
			$this->load->library('Format', NULL, 'format');
		}
		return $this->_format;
	}

	/**
	 * @param \Format $obj
	 */
	public function setFormat($obj) {
		$this->_format = $obj;
	}

	/**
	 * @return \UserManager
	 */
	public function getUserManager() {
		if (!isset($this->_userManager)) {
			$this->load->library('UserManager', NULL, 'userManager');
		}
		return $this->_userManager;
	}

	/**
	 * @param \UserManager $obj
	 */
	public function setUserManager($obj) {
		$this->_userManager = $obj;
	}

	/**
	 * @return \Validate
	 */
	public function getValidate() {
		if (!isset($this->_validate)) {
			$this->load->library('Validate', NULL, 'validate');
		}
		return $this->_validate;
	}

	/**
	 * @param \Validate $obj
	 */
	public function setValidate($obj) {
		$this->_validate = $obj;
	}

	/**
	 * @return \PDO
	 */
	public function getPDO() {
		if (!isset($this->_pdo)) {
			$this->_pdo = new PDO('mysql:dbname=lq;host=walker.dlinkddns.com', 'admin', 'kek-hap-dog0369');
		}
		return $this->_pdo;
	}

	/**
	 * @param \PDO $obj
	 */
	public function setPDO($obj) {
		if (isset($this->_pdo)) {
			$this->_pdo = NULL; // closes connection
		}
		$this->_pdo = $obj;
	}
}
