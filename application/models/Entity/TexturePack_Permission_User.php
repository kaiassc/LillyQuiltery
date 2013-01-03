<?php

namespace Entity; 

require_once('application/models/Entity/Entity.php');

class TexturePack_Permission_User extends Entity {

	protected static $_propertyNames;
	
	
	/** @var int $TexturePackID */
	protected $TexturePackID;

    /** @var int $PermissionID */
    protected $PermissionID;

	/** @var int $UserID */
	protected $UserID;
	
    /** @var int $creationDate */
    protected $CreationDate;


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
	 * @return TexturePack_Permission_User
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
     * Set permissionID
     *
     * @param int $permissionID
     * @return TexturePack_Permission_User
     */
    public function setPermissionID($permissionID) {
        $this->PermissionID = intval($permissionID);
        return $this;
    }

    /**
     * Get permissionID
     *
     * @return int 
     */
    public function getPermissionID() {
        return $this->PermissionID;
    }

	/**
	 * Set userID
	 *
	 * @param int $userID
	 * @return TexturePack_Permission_User
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
     * Set creationDate
     *
     * @param int $creationDate
     * @return TexturePack_Permission_User
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