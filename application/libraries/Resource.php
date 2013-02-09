<?php 

/**
 * Created by Brad Walker on 9/3/12 at 6:23 PM
 */

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

require_once('application/libraries/Library.php');

class Resource extends Library {

	const BROWSABLE_IMAGE_WIDTH   = 215;
	const BROWSABLE_IMAGE_HEIGHT  = 120;
	
	
	/** @var Format $format */
	protected $format;
	
	
	public function __construct() {
		parent::__construct();
		
		$this->format = $this->currentController->getFormat();
	}
	
	
	/**
	 * returns a Pattern's browsable image path
	 * @param \Entity\Pattern $pattern instance of a Pattern loaded via Doctrine
	 * @return string
	 */
	public function patternBrowsableImagePath(\Entity\Pattern $pattern) {
		return $this->patternBrowsableImagePathFromProperties($pattern->getID(), $pattern->getName());
	}

	/**
	 * returns a Pattern's browsable image path
	 * @param int $patternID Pattern id
	 * @param string $patternName
	 * @return string
	 */
	public function patternBrowsableImagePathFromProperties($patternID, $patternName) {
		$formattedPatternID = $this->format->titleForURL($patternName);
		
		return "data/P/{$patternID}/{$formattedPatternID}-pattern-thumbnail.png";
	}
	
	/**
	 * returns an array of the Pattern's display image paths
	 * @param \Entity\Pattern $pattern 
	 * @return array
	 */
	public function patternDisplayImagePaths($pattern) {
		$formattedPatternID = $this->format->titleForURL($pattern->getName());
		
		return glob("data/P/{$pattern->getID()}/D/{$formattedPatternID}-pattern-display-*.png");
	}
	
	/**
	 * returns an array of the Bundles's display image paths
	 * @param \Entity\Bundle $bundle 
	 * @return array
	 */
	public function bundleDisplayImagePaths($bundle) {
		$formattedBundleID = $this->format->titleForURL($bundle->getName());
		
		return glob("data/B/{$bundle->getID()}/D/{$formattedBundleID}-display-*.png");
	}
	
	/**
	 * returns a User's avatar image path (ex. 'data/User/USER_ID/USERNAME-avatar.png')
	 * @param \Entity\User $user instance of a User loaded via Doctrine
	 * @return string
	 */
	public function userAvatarImagePath(\Entity\User $user) {
		$userID = $user->getID();
		$formattedUsername = $this->format->titleForURL($user->getUsername());

		return "data/U/{$userID}/{$formattedUsername}_avatar.png";
	}
	
}
