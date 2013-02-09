<?php

namespace Entity;

require_once('application/models/Entity/Entity.php');

class Pattern extends Entity {

	protected static $_propertyNames;


	/** @var int $ID */
	protected $ID;

	/** @var int $PatternTypeID */
	protected $PatternTypeID;

	/** @var int $UserID */
	protected $UserID;

	/** @var string $Name */
	protected $Name;

	/** @var string $Description */
	protected $Description;

	/** @var float $Price */
	protected $Price;

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
	 * Set patternTypeID
	 *
	 * @param int $patternTypeID
	 * @return Pattern
	 */
	public function setPatternTypeID($patternTypeID) {
		$this->PatternTypeID = $patternTypeID;
		return $this;
	}

	/**
	 * Get patternTypeID
	 *
	 * @return int
	 */
	public function getPatternTypeID() {
		return $this->PatternTypeID;
	}

	/**
	 * Set userID
	 *
	 * @param int $userID
	 * @return Pattern
	 */
	public function setUserID($userID) {
		$this->UserID = $userID;
		return $this;
	}

	/**
	 * Get userID
	 *
	 * @return int
	 */
	public function getUserID() {
		return $this->UserID;
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
	 * Set description
	 *
	 * @param string $description
	 * @return Pattern
	 */
	public function setDescription($description) {
		$this->Description = $description;
		return $this;
	}

	/**
	 * Get description
	 *
	 * @return string
	 */
	public function getDescription() {
		return $this->Description;
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
	 * Set creationDate
	 *
	 * @param int $creationDate
	 * @return Pattern
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
	 * @return Pattern
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