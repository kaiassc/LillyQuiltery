<?php

namespace Entity; 

require_once('application/models/Entity/Entity.php');

class Permission extends Entity {

	protected static $_propertyNames;
	
	
    /** @var int $ID */
    protected $ID;

	/** @var string $Name */
	protected $Name;

	/** @var int $Code */
	protected $Code;

	/** @var int $Ordinal */
	protected $Ordinal;

    
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
	 * @return Permission
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
	 * Set code
	 *
	 * @param int $code
	 * @return Permission
	 */
	public function setCode($code) {
		$this->Code = $code;
		return $this;
	}
	
	/**
	 * Get code
	 *
	 * @return int
	 */
	public function getCode() {
		return $this->Code;
	}

	/**
	 * Set ordinal
	 *
	 * @param int $ordinal
	 * @return Permission
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
}