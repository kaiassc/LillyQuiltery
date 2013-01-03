<?php

namespace Entity; 

require_once('application/models/Entity/Entity.php');

class CustomizerPicker extends Entity {

	protected static $_propertyNames;
	
	
    /** @var int $ID */
    protected $ID;

	/** @var int $CustomizerSectionID */
	protected $CustomizerSectionID;

	/** @var int $TexturePackID */
	protected $TexturePackID;

    /** @var string $Name */
    protected $Name;

	/** @var bool $IsEnabled */
	protected $IsEnabled;
	
    /** @var int $Ordinal */
    protected $Ordinal;

    /** @var int $CreationDate */
    protected $CreationDate;

    /** @var int $EditDate */
    protected $EditDate;
	
	
	/** @var array */
	protected $_textureDefinitions;
	

    /**
     * Get ID
     *
     * @return int 
     */
    public function getID() {
        return $this->ID;
    }

	/**
	 * Set texturePackID
	 *
	 * @param int $texturePackID
	 * @return CustomizerPicker
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
	 * Set customizerSectionID
	 *
	 * @param int $customizerSectionID
	 * @return CustomizerPicker
	 */
	public function setCustomizerSectionID($customizerSectionID) {
		$this->CustomizerSectionID = intval($customizerSectionID);
		return $this;
	}

	/**
	 * Get customizerSectionID
	 *
	 * @return CustomizerSection
	 */
	public function getCustomizerSectionID() {
		return $this->CustomizerSectionID;
	}

    /**
     * Set name
     *
     * @param string $name
     * @return CustomizerPicker
     */
    public function setName($name) {
        $this->Name = $name;
        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName() {
        return $this->Name;
    }

	/**
	 * Set isEnabled
	 *
	 * @param bool $isEnabled
	 * @return CustomizerSection
	 */
	public function setIsEnabled($isEnabled) {
		$this->IsEnabled = $isEnabled == TRUE;
		return $this;
	}

	/**
	 * Get isEnabled
	 *
	 * @return bool
	 */
	public function getIsEnabled() {
		return $this->IsEnabled;
	}
	
    /**
     * Set ordinal
     *
     * @param int $ordinal
     * @return CustomizerPicker
     */
    public function setOrdinal($ordinal) {
        $this->Ordinal = intval($ordinal);
        return $this;
    }

    /**
     * Get ordinal
     *
     * @return int 
     */
    public function getOrdinal()  {
        return $this->Ordinal;
    }

    /**
     * Set creationDate
     *
     * @param int $creationDate
     * @return CustomizerPicker
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
     * @return CustomizerPicker
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
	 * Add TextureDefinition
	 *
	 * @param TextureDefinition $textureDefinition
	 *
	 * @return CustomizerPicker
	 */
	public function addTextureDefinition(TextureDefinition $textureDefinition) {
		$this->_textureDefinitions[$textureDefinition->getID()] = $textureDefinition;
	}

	/**
	 * Get textureDefinitions
	 *
	 * @return array
	 */
	public function getTextureDefinitions() {
		return $this->_textureDefinitions;
	}
}