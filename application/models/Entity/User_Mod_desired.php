<?php

namespace Entity; 

require_once('application/models/Entity/Entity.php');

class User_Mod extends Entity {

	protected static $_propertyNames;
	
	
	/** @var int $TexturePackID */
	protected $UserID;

	/** @var int $ModID */
	protected $ModID;

	/** @var int $CreationDate */
	protected $CreationDate;


	/**
	 * Set userID
	 *
	 * @param int $userID
	 * @return User_Mod
	 */
	public function setUserID($userID) {
		$this->UserID = intval($userID);
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
	 * Set modID
	 *
	 * @param int $modID
	 * @return User_Mod
	 */
	public function setModID($modID) {
		$this->ModID = intval($modID);
		return $this;
	}
	
	/**
	 * Get modID
	 *
	 * @return int
	 */
	public function getModID() {
		return $this->ModID;
	}

	/**
	 * Set creationDate
	 *
	 * @param int $creationDate
	 * @return User_Mod
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
}