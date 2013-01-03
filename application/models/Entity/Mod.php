<?php

namespace Entity; 

require_once('application/models/Entity/Entity.php');

class Mod extends Entity {

	protected static $_propertyNames;
	
	
    /** @var int $ID */
    protected $ID;

    /** @var string $Name */
    protected $Name;

    /** @var string $Version */
    protected $Version;

    /** @var int $TextureCount */
    protected $TextureCount;

	/** @var int $Ordinal */
	protected $Ordinal;

    /** @var bool $IsEnabled */
    protected $IsEnabled;

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
     * Set name
     *
     * @param string $name
     * @return Mod
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
     * Set version
     *
     * @param string $version
     * @return Mod
     */
    public function setVersion($version) {
        $this->Version = $version;
        return $this;
    }

    /**
     * Get version
     *
     * @return string 
     */
    public function getVersion() {
        return $this->Version;
    }

    /**
     * Set textureCount
     *
     * @param int $textureCount
     * @return Mod
     */
    public function setTextureCount($textureCount) {
        $this->TextureCount = $textureCount;
        return $this;
    }

    /**
     * Get textureCount
     *
     * @return int 
     */
    public function getTextureCount() {
        return $this->TextureCount;
    }

	/**
	 * Set ordinal
	 *
	 * @param int $ordinal
	 * @return Mod
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
     * Set isEnabled
     *
     * @param bool $isEnabled
     * @return Mod
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
     * Set creationDate
     *
     * @param int $creationDate
     * @return Mod
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
     * @return Mod
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