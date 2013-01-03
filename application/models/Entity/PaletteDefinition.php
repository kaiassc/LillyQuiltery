<?php

namespace Entity;

require_once('application/models/Entity/Entity.php');

class PaletteDefinition extends Entity {

	protected static $_propertyNames;
	
	
    /** @var int $ID */
    protected $ID;

	/** @var int $ModID */
	protected $ModID;

	/** @var int $TexturePackID */
	protected $TexturePackID;
	
    /** @var string $SavePath */
    protected $SavePath;

    /** @var int $Width */
    protected $Width;

    /** @var int $Height */
    protected $Height;

    /** @var bool $IsResizable */
    protected $IsResizable;

    /** @var int $CreationDate */
    protected $CreationDate;

    /** @var int $EditDate */
    protected $EditDate;
	
    
    /**
     * Get ID
     *
     * @return int 
     */
    public function getID() {
        return $this->ID;
    }

	/**
	 * Set int
	 *
	 * @param int $modID
	 * @return PaletteDefinition
	 */
	public function setModID($modID) {
		$this->ModID = intval($modID);
		return $this;
	}

	/**
	 * Get modification
	 *
	 * @return int
	 */
	public function getModID() {
		return $this->ModID;
	}

	/**
	 * Set texturePackID
	 *
	 * @param int $texturePackID
	 * @return PaletteDefinition
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
     * Set savePath
     *
     * @param string $savePath
     * @return PaletteDefinition
     */
    public function setSavePath($savePath) {
        $this->SavePath = $savePath;
        return $this;
    }

    /**
     * Get savePath
     *
     * @return string 
     */
    public function getSavePath() {
        return $this->SavePath;
    }

    /**
     * Set width
     *
     * @param int $width
     * @return PaletteDefinition
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
     * @return PaletteDefinition
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
     * Set isResizable
     *
     * @param bool $isResizable
     * @return PaletteDefinition
     */
    public function setIsResizable($isResizable) {
        $this->IsResizable = $isResizable == TRUE;
        return $this;
    }

    /**
     * Get isResizable
     *
     * @return bool 
     */
    public function getIsResizable() {
        return $this->IsResizable;
    }

    /**
     * Set creationDate
     *
     * @param int $creationDate
     * @return PaletteDefinition
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

    /**
     * Set editDate
     *
     * @param int $editDate
     * @return PaletteDefinition
     */
    public function setEditDate($editDate) {
        $this->EditDate = $editDate;
        return $this;
    }

    /**
     * Get editDate
     *
     * @return int 
     */
    public function getEditDate() {
        return $this->EditDate;
    }
}