<?php

namespace Entity; 

require_once('application/models/Entity/Entity.php');

class Palette extends Entity {

	protected static $_propertyNames;
	
	
    /** @var int $ID */
    protected $ID;

	/** @var int $PaletteDefinitionID */
	protected $PaletteDefinitionID;

	/** @var int $TexturePackID */
	protected $TexturePackID;

	/** @var int $GameResolutionID */
	protected $GameResolutionID;

    /** @var string $ImagePath */
    protected $ImagePath;

    /** @var string $ImageHash */
    protected $ImageHash;

	/** @var int $Width */
	protected $Width;

    /** @var int $Height */
    protected $Height;

    /** @var int $CreationDate */
    protected $CreationDate;

    
    /**
     * Get ID
     *
     * @return int 
     */
    public function getID() {
        return $this->ID;
    }

	/**
	 * Set paletteDefinitionID
	 *
	 * @param int $paletteDefinitionID
	 * @return Palette
	 */
	public function setPaletteDefinitionID($paletteDefinitionID) {
		$this->PaletteDefinitionID = intval($paletteDefinitionID);
		return $this;
	}
	
    /**
     * Get paletteDefinitionID
     *
     * @return int 
     */
    public function getPaletteDefinitionID() {
        return $this->PaletteDefinitionID;
    }

	/**
	 * Set texturePackID
	 *
	 * @param int $texturePackID
	 * @return Palette
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
	 * Set gameResolutionID
	 *
	 * @param int $gameResolutionID
	 * @return Palette
	 */
	public function setGameResolutionID($gameResolutionID) {
		$this->GameResolutionID = intval($gameResolutionID);
		return $this;
	}

	/**
	 * Get gameResolutionID
	 *
	 * @return int
	 */
	public function getGameResolutionID() {
		return $this->GameResolutionID;
	}
	
    /**
     * Set imagePath
     *
     * @param string $imagePath
     * @return Palette
     */
    public function setImagePath($imagePath) {
        $this->ImagePath = $imagePath;
        return $this;
    }

    /**
     * Get imagePath
     *
     * @return string 
     */
    public function getImagePath() {
        return $this->ImagePath;
    }

    /**
     * Set imageHash
     *
     * @param string $imageHash
     * @return Palette
     */
    public function setImageHash($imageHash) {
        $this->ImageHash = $imageHash;
        return $this;
    }

    /**
     * Get imageHash
     *
     * @return string 
     */
    public function getImageHash() {
        return $this->ImageHash;
    }

    /**
     * Set width
     *
     * @param int $width
     * @return Palette
     */
    public function setWidth($width) {
        $this->Width = $width;
        return $this;
    }

    /**
     * Get width
     *
     * @return int 
     */
    public function getWidth() {
        return $this->Width;
    }

    /**
     * Set height
     *
     * @param int $height
     * @return Palette
     */
    public function setHeight($height) {
        $this->Height = $height;
        return $this;
    }

    /**
     * Get height
     *
     * @return int 
     */
    public function getHeight() {
        return $this->Height;
    }
	
    /**
     * Set creationDate
     *
     * @param int $creationDate
     * @return Palette
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