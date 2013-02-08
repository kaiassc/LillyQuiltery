<?php
/**
 * Created by Brad Walker on 9/3/12 at 7:25 PM
*/

require_once('Controller.php');

class PageController extends Controller {
	
	/* @var string $pageName */
	public $pageName;
	
	/* @var string $title */
	public $title;
	
	
	/* @var \Render $render */
	public $render;
	
	/* @var \Format $format */
	public $format;
	
	/* @var \UserManager $userManager */
	public $userManager;
	
		
	public function __construct() {
		parent::__construct();
		
		$segments = preg_split('/[_]/', str_replace('_Controller', '', $this->className));
		$pageName = '';
		foreach ($segments as $segment) {
			if ($pageName !== '')
				$pageName .= '-';
			$pageName .= lcfirst($segment);
		}
		$this->pageName = $pageName;
		
		$this->title = 'Lilly Quiltery';
		
		$this->render = $this->getRender();
		$this->format = $this->getFormat();
		$this->userManager = $this->getUserManager();
		
	}
	
}
