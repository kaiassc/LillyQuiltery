<?php

namespace Entity; 

require_once('application/models/Entity/Entity.php');

class UserRank extends Entity {

	protected static $_propertyNames;
	
	
    /** @var int $ID */
    protected $ID;

    /** @var string $Name */
    protected $Name;

	/** @var string $Value */
	protected $Value;

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
     * @return UserRank
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
	 * @return UserRank
	 */
	public function setValue($value) {
		$this->Value = $value;
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
     * Set creationDate
     *
     * @param int $creationDate
     * @return UserRank
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
     * @return UserRank
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