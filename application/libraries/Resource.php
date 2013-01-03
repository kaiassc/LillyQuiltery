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
	 * returns a CustomizerSection's tab icon
	 * @param \Entity\CustomizerSection $section instance of a CustomizerSection loaded via Doctrine
	 * @return string
	 */
	public function sectionTabIcon(\Entity\CustomizerSection $section) {
		$sectionID = $section->getID();
		$formattedSectionName = $this->format->titleForURL($section->getName());
 
		return "data/CS/{$sectionID}/{$formattedSectionName}-section-icon.png";
	}
	
	/**
	 * returns a Texture's display image path
	 * @param \Entity\Texture $texture instance of a Texture loaded via Doctrine
	 * @param int $scale scale of the display image to return
	 * @param bool $create whether or not to create display image at $scale if it doesn't exist
	 * @return string
	 */
	public function textureImagePathDisplay(\Entity\Texture $texture, $scale = -1, $create = false) {
		return "data/TP/62/T/1/7057/jolicraft-apple-display-48x96.png";
		
		/*
		$pack = $texture->getTexturePack();
		$packID = $pack->getID();
		$definition = $texture->getTextureDefinition();
		$definitionID = $definition->getID();
		$textureID = $texture->getID();
		$formattedName = $this->format->titleForURL($pack->getName().'-'.$definition->getName());		
		
		if ($scale === -1 || intval($scale) <= 0) {
			$scale = $definition->getDisplayScale();
		}
		$width = $scale * $definition->getWidth();
		$height = $scale * $definition->getHeight();
		
		$imagePath = "data/TP/{$packID}/T/{$definitionID}/{$textureID}/{$formattedName}-display-{$width}x{$height}.png";
		
		if ($create) {
			if (!file_exists($imagePath)) {
				// TODO: create texture display image on-demand
			}
		}

		return $imagePath;
		*/
	}

	/**
	 * returns a Texture's raw image path
	 * @param \Entity\Texture $texture instance of a Texture loaded via Doctrine
	 * @return string
	 */
	public function textureImagePathRaw(\Entity\Texture $texture) {
		$pack = $texture->getTexturePack();
		$packID = $pack->getID();
		$definition = $texture->getTextureDefinition();
		$definitionID = $definition->getID();
		$textureID = $texture->getID();
		$formattedName = $this->format->titleForURL($pack->getName().'-'.$definition->getName());
		
		return "data/TP/{$packID}/T/{$definitionID}/{$textureID}/{$formattedName}-raw.png";
	}

	/**
	 * returns a TexturePack's browsable image path
	 * @param \Entity\TexturePack $texturePack instance of a TexturePack loaded via Doctrine
	 * @return string
	 */
	public function texturePackBrowsableImagePath(\Entity\TexturePack $texturePack) {
		return $this->texturePackBrowsableImagePathFromProperties($texturePack->getID(), $texturePack->getName());
	}

	/**
	 * returns a TexturePack's browsable image path
	 * @param int $packID TexturePack id
	 * @param string $packName
	 * @return string
	 */
	public function texturePackBrowsableImagePathFromProperties($packID, $packName) {
		if (rand(0,1) == 0) {
			$packID = 62;
			$packName = 'Jolicraft';
		}
		else {
			$packID = 4477;
			$packName = 'DokuCraft - The Saga Continues';
		}
		
		$formattedPackName = $this->format->titleForURL($packName);

		return "data/TP/{$packID}/{$formattedPackName}-texture-pack-browsable.png";
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
