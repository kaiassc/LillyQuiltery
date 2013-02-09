<?php

namespace Entity; 

require_once('application/models/Entity/Entity.php');

class Bundle extends Entity {

	protected static $_propertyNames;
	
	
    /** @var int $ID */
    protected $ID;
	
    /** @var string $Name */
    protected $Name;

    /** @var float $Price */
    protected $Price;

    /** @var bool $IsEnabled */
    protected $IsEnabled;
	
	
	protected $_patterns;
	
    
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
     * @return Pattern
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
     * Set price
     *
     * @param float $price
     * @return Pattern
     */
    public function setPrice($price) {
        $this->Price = $price;
        return $this;
    }

    /**
     * Get price
     *
     * @return int 
     */
    public function getPrice() {
        return $this->Price;
    }

    /**
     * Set isEnabled
     *
     * @param bool $isEnabled
     * @return Pattern
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
	 * Add pattern
	 *
	 * @param Pattern $pattern
	 *
	 * @return Bundle
	 */
	public function addPattern(Pattern $pattern) {
		$this->_patterns[$pattern->getID()] = $pattern;
		return $this;
	}

	/**
	 * Get patterns
	 *
	 * @return array
	 */
	public function getPatterns() {
		return $this->_patterns;
	}
}