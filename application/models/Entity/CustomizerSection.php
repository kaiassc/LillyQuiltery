<?php

namespace Entity; 

require_once('application/models/Entity/Entity.php');

class CustomizerSection extends Entity {

	protected static $_propertyNames;
	
	
    /** @var int $ID */
    protected $ID;

	/** @var int $TexturePackID */
	protected $TexturePackID;

    /** @var string $Name */
    protected $Name;

    /** @var bool $IsModSection */
    protected $IsModSection;

	/** @var bool $IsEnabled */
	protected $IsEnabled;

	/** @var bool $IsDefault */
	protected $IsDefault;

    /** @var int $Ordinal */
    protected $Ordinal;

    /** @var int $CreationDate */
    protected $CreationDate;

    /** @var int $EditDate */
    protected $EditDate;

	
	/** @var array $_customizerPickers */
	protected $_customizerPickers;
   
	
	
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
	 * @return CustomizerSection
	 */
	public function setTexturePackID($texturePackID) {
		$this->TexturePackID = intval($texturePackID);
		return $this;
	}

	/**
	 * Get texturePackID
	 *
	 * @return TexturePack
	 */
	public function getTexturePackID() {
		return $this->TexturePackID;
	}
	
    /**
     * Set name
     *
     * @param string $name
     * @return CustomizerSection
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
     * Set isModSection
     *
     * @param bool $isModSection
     * @return CustomizerSection
     */
    public function setIsModSection($isModSection) {
        $this->IsModSection = $isModSection == TRUE;
        return $this;
    }

    /**
     * Get isModSection
     *
     * @return bool 
     */
    public function getIsModSection() {
        return $this->IsModSection;
    }

	/**
	 * Set isDefault
	 *
	 * @param bool $isDefault
	 * @return CustomizerSection
	 */
	public function setIsDefault($isDefault) {
		$this->IsDefault = $isDefault == TRUE;
		return $this;
	}

	/**
	 * Get isDefault
	 *
	 * @return bool
	 */
	public function getIsDefault() {
		return $this->IsDefault;
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
     * @return CustomizerSection
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
    public function getOrdinal() {
        return $this->Ordinal;
    }

    /**
     * Set creationDate
     *
     * @param int $creationDate
     * @return CustomizerSection
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
     * @return CustomizerSection
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
	 * Add CustomizerPicker
	 *
	 * @param CustomizerPicker $customizerPicker
	 *
	 * @return CustomizerSection
	 */
	public function addCustomizerPicker(CustomizerPicker $customizerPicker) {
		$this->_customizerPickers[$customizerPicker->getID()] = $customizerPicker;
	}

	/**
	 * Get customizerPickers
	 *
	 * @return array
	 */
	public function getCustomizerPickers() {
		return $this->_customizerPickers;
	}
}