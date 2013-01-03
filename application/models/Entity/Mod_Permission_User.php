<?php

namespace Entity; 

require_once('application/models/Entity/Entity.php');

class Mod_Permission_User extends Entity {

	protected static $_propertyNames;
	
	
    /** @var int $ModID */
    protected $ModID;

    /** @var int $PermissionID */
    protected $PermissionID;

	/** @var int $UserID */
	protected $UserID;


    /**
     * Set modID
     *
     * @param int $modID
     * @return Mod_Permission_User
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
	 * Set permissionID
	 *
	 * @param int $permissionID
	 * @return Mod_Permission_User
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
	 * @return Mod_Permission_User
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
}