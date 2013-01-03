<?php

namespace Entity; 

require_once('application/models/Entity/Entity.php');

class User_TexturePack_favorite extends Entity {

	protected static $_propertyNames;
	

	/** @var int $UserID */
	protected $UserID;

	/** @var int $TexturePackID */
	protected $TexturePackID;

	/** @var int $ViewCount */
	protected $ViewCount;

	/** * @var int $LastViewDate */
	protected $LastViewDate;

	/** @var int $CreationDate */
	protected $CreationDate;

	
	/**
	 * Set userID
	 *
	 * @param int $userID
	 * @return User_TexturePack_favorite
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
	 * Set texturePackID
	 *
	 * @param int $texturePackID
	 * @return User_TexturePack_favorite
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
     * Set viewCount
     *
     * @param int $viewCount
     * @return User_TexturePack_favorite
     */
    public function setViewCount($viewCount) {
        $this->ViewCount = $viewCount;
        return $this;
    }

    /**
     * Get viewCount
     *
     * @return int 
     */
    public function getViewCount() {
        return $this->ViewCount;
    }

    /**
     * Set lastViewDate
     *
     * @param int $lastViewDate
     * @return User_TexturePack_favorite
     */
    public function setLastViewDate($lastViewDate) {
        $this->LastViewDate = $lastViewDate;
        return $this;
    }

    /**
     * Get lastViewDate
     *
     * @return int 
     */
    public function getLastViewDate() {
        return $this->LastViewDate;
    }

    /**
     * Set creationDate
     *
     * @param int $creationDate
     * @return User_TexturePack_favorite
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