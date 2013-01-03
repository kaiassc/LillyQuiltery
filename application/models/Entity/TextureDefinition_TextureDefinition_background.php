<?php

namespace Entity; 

require_once('application/models/Entity/Entity.php');

class TextureBackgroundEntry extends Entity {

	protected static $_propertyNames;
	
	
    /** @var int $ID */
    protected $ID;

	/** @var int $ForegroundTextureDefinitionID */
	protected $ForegroundTextureDefinitionID;

	/** @var int $BackgroundTextureDefinitionID */
	protected $BackgroundTextureDefinitionID;
	
    /** @var int $Z */
    protected $Z;

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
     * Set z
     *
     * @param int $z
     * @return TextureBackgroundEntry
     */
    public function setZ($z) {
        $this->Z = $z;
        return $this;
    }

    /**
     * Get z
     *
     * @return int 
     */
    public function getZ() {
        return $this->Z;
    }

    /**
     * Set creationDate
     *
     * @param int $creationDate
     * @return TextureBackgroundEntry
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
     * @return TextureBackgroundEntry
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

    /**
     * Set foregroundTextureDefinitionID
     *
     * @param int $foregroundTextureDefinitionID
     * @return TextureBackgroundEntry
     */
    public function setForegroundTextureDefinitionID($foregroundTextureDefinitionID) {
        $this->ForegroundTextureDefinitionID = intval($foregroundTextureDefinitionID);
        return $this;
    }

    /**
     * Get foregroundTextureDefinitionID
     *
     * @return int 
     */
    public function getForegroundTextureDefinitionID() {
        return $this->ForegroundTextureDefinitionID;
    }

	/**
	 * Set backgroundTextureDefinitionID
	 *
	 * @param int $backgroundTextureDefinitionID
	 * @return TextureBackgroundEntry
	 */
	public function setBackgroundTextureDefinitionID($backgroundTextureDefinitionID) {
		$this->BackgroundTextureDefinitionID = intval($backgroundTextureDefinitionID);
		return $this;
	}

	/**
	 * Get backgroundTextureDefinitionID
	 *
	 * @return int
	 */
	public function getBackgroundTextureDefinitionID() {
		return $this->BackgroundTextureDefinitionID;
	}
}