<?php

namespace Entity;

require_once('application/models/Entity/Entity.php');

class TexturePack_Mod_support extends Entity {

	protected static $_propertyNames;
	
	
	/** @var int $TexturePackID */
	protected $TexturePackID;

	/** @var int $ModID */
	protected $ModID;

	/** @var int $CreationDate */
	protected $CreationDate;


	/**
	 * Set texturePackID
	 *
	 * @param int $texturePackID
	 * @return TexturePack_Mod_support
	 */
	public function setTexturePackID($texturePackID) {
		$this->TexturePackID = intval($texturePackID);
		return $this;
	}
	
    /**
     * Get texturePackID
     *
     * @return int 
     */
    public function getTexturePackID() {
        return $this->TexturePackID;
    }

	/**
	 * Set modID
	 *
	 * @param int $modID
	 * @return TexturePack_Mod_support
	 */
	public function setModID($modID) {
		$this->ModID = intval($modID);
		return $this;
	}
	
	/**
	 * Get modID
	 *
	 * @return int
	 */
	public function getModID() {
		return $this->ModID;
	}

	/**
	 * Set creationDate
	 *
	 * @param int $creationDate
	 * @return TexturePack_Mod_support
	 */
	public function setCreationDate($creationDate) {
		$this->CreationDate = $creationDate;
		return $this;
	}

	/**
	 * Get creationDate
	 *
	 * @return int
	 */
	public function getCreationDate() {
		return $this->CreationDate;
	}
}