<?php

namespace Entity; 

require_once('application/models/Entity/Entity.php');

class TexturePackAd extends Entity {

	protected static $_propertyNames;
	
	
    /** @var int $ID */
    protected $ID;

	/** @var int $TexturePackAdFormatID */
	protected $TexturePackAdFormatID;

	/** @var int $TexturePackID */
	protected $TexturePackID;

	/** @var int $TexturePackFlavorID */
	protected $TexturePackFlavorID;
	
    /** @var int $CreationDate */
    protected $CreationDate;

    
    /**
     * Get ID
     *
     * @return int 
     */
    public function getID()
    {
        return $this->ID;
    }

	/**
	 * Set texturePackAdFormatID
	 *
	 * @param int $texturePackAdFormatID
	 * @return TexturePackAd
	 */
	public function setTexturePackAdFormatID($texturePackAdFormatID) {
		$this->TexturePackAdFormatID = intval($texturePackAdFormatID);
		return $this;
	}

	/**
	 * Get texturePackAdFormatID
	 *
	 * @return int
	 */
	public function getTexturePackAdFormatID() {
		return $this->TexturePackAdFormatID;
	}

	/**
	 * Set texturePackID
	 *
	 * @param int $texturePackID
	 * @return TexturePackAd
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
	 * Set texturePackFlavorID
	 *
	 * @param int $texturePackFlavorID
	 * @return TexturePackAd
	 */
	public function setTexturePackFlavorID($texturePackFlavorID) {
		$this->TexturePackFlavorID = intval($texturePackFlavorID);
		return $this;
	}

	/**
	 * Get texturePackFlavorID
	 *
	 * @return int
	 */
	public function getTexturePackFlavorID() {
		return $this->TexturePackFlavorID;
	}
	
    /**
     * Set creationDate
     *
     * @param int $creationDate
     * @return TexturePackAd
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