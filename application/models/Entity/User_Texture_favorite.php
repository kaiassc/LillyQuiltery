<?php

namespace Entity; 

require_once('application/models/Entity/Entity.php');

class User_Texture_favorite extends Entity {

	protected static $_propertyNames;

	
	/** @var int $UserID */
	protected $UserID;

	/** @var int $TextureID */
	protected $TextureID;
	
    /** @var int $CreationDate */
    protected $CreationDate;


	/**
	 * Set userID
	 *
	 * @param int $userID
	 * @return User_Texture_favorite
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
	 * Set textureID
	 *
	 * @param int $textureID
	 * @return User_Texture_favorite
	 */
	public function setTextureID($textureID) {
		$this->TextureID = intval($textureID);
		return $this;
	}

	/**
	 * Get textureID
	 *
	 * @return int
	 */
	public function getTextureID() {
		return $this->TextureID;
	}

    /**
     * Set creationDate
     *
     * @param int $creationDate
     * @return User_Texture_favorite
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