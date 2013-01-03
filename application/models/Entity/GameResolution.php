<?php

namespace Entity; 

require_once('application/models/Entity/Entity.php');

class GameResolution extends Entity {

	protected static $_propertyNames;
	
	
    /** @var int $ID */
    protected $ID;

    /** @var string $Name */
    protected $Name;

    /** @var int $Value */
    protected $Value;
	
    /** @var bool $IsEnabled */
    protected $IsEnabled;

    /** @var bool $Ordinal */
    protected $Ordinal;

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
     * @return GameResolution
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
     * Set value
     *
     * @param int $value
     * @return GameResolution
     */
    public function setValue($value) {
        $this->Value = intval($value);
        return $this;
    }

    /**
     * Get value
     *
     * @return int 
     */
    public function getValue() {
        return $this->Value;
    }

    /**
     * Set isEnabled
     *
     * @param bool $isEnabled
     * @return GameResolution
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
     * @param bool $ordinal
     * @return GameResolution
     */
    public function setOrdinal($ordinal) {
        $this->Ordinal = intval($ordinal);
        return $this;
    }

    /**
     * Get ordinal
     *
     * @return bool 
     */
    public function getOrdinal() {
        return $this->Ordinal;
    }

    /**
     * Set creationDate
     *
     * @param int $creationDate
     * @return GameResolution
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
     * @return GameResolution
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