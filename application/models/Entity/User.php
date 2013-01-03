<?php

namespace Entity;

require_once('application/models/Entity/Entity.php');

class User extends Entity {

	protected static $_propertyNames;
	
	
    /** @var int $ID */
    protected $ID;

	/** @var int $UserRankID */
	protected $UserRankID;
	
    /** @var string $username */
    protected $Username;

    /** @var string $password */
	protected $Password;

    /** @var string $email */
    protected $Email;

    /** @var string $loginHash */
	protected $LoginHash;

    /** @var int $loginHashExpirationDate */
	protected $LoginHashExpirationDate;

	/** @var string $VerificationHash */
	protected $VerificationHash;
	
    /** @var bool $packLimit */
    protected $PackLimit;

    /** @var bool $IsVerified */
    protected $IsVerified;

    /** @var bool $isPremium */
    protected $IsPremium;

    /** @var bool $hasAppPackUpdates */
    protected $HasAppPackUpdates;

    /** @var bool $hasAppSiteUpdates */
    protected $HasAppSiteUpdates;

    /** @var bool $hasAppYellowText */
    protected $HasAppYellowText;

    /** @var bool $hasAppBrowseDetailed */
    protected $HasAppBrowseDetailed;

    /** @var int $creationDate */
    protected $CreationDate;

    /** @var int $editDate */
    protected $EditDate;
	
	
    /** @var array $_texturePackPermissions */
	protected $_texturePackPermissions;

	/** @var array $_texturePacks */
	protected $_texturePacks;

	/** @var array $_favoritePacks */
	protected $_favoritePacks;
	
	
    /**
     * Get ID
     *
     * @return int 
     */
    public function getID() {
        return $this->ID;
    }

	/**
	 * Set userRankID
	 *
	 * @param int $userRankID
	 * @return User
	 */
	public function setUserRankID($userRankID) {
		$this->UserRankID = intval($userRankID);
		return $this;
	}

	/**
	 * Get userRankID
	 *
	 * @return int
	 */
	public function getUserRankID() {
		return $this->UserRankID;
	}

	/**
     * Set username
     *
     * @param string $username
     * @return User
     */
    public function setUsername($username) {
        $this->Username = $username;
        return $this;
    }

    /**
     * Get username
     *
     * @return string 
     */
    public function getUsername() {
        return $this->Username;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return User
     */
    public function setPassword($password) {
        $this->Password = $password;
        return $this;
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword() {
        return $this->Password;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return User
     */
    public function setEmail($email) {
        $this->Email = $email;
        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail() {
        return $this->Email;
    }

    /**
     * Set loginHash
     *
     * @param string $loginHash
     * @return User
     */
    public function setLoginHash($loginHash) {
        $this->LoginHash = $loginHash;
        return $this;
    }

    /**
     * Get loginHash
     *
     * @return string 
     */
    public function getLoginHash() {
        return $this->LoginHash;
    }

    /**
     * Set loginHashExpirationDate
     *
     * @param int $loginHashExpirationDate
     * @return User
     */
    public function setLoginHashExpirationDate($loginHashExpirationDate) {
        $this->LoginHashExpirationDate = $loginHashExpirationDate;
        return $this;
    }

    /**
     * Get loginHashExpirationDate
     *
     * @return int 
     */
    public function getLoginHashExpirationDate() {
        return $this->LoginHashExpirationDate;
    }

	/**
	 * Set verificationHash
	 *
	 * @param string $verificationHash
	 * @return User
	 */
	public function setVerificationHash($verificationHash) {
		$this->VerificationHash = $verificationHash;
		return $this;
	}

	/**
	 * Get verificationHash
	 *
	 * @return string
	 */
	public function getVerificationHash() {
		return $this->VerificationHash;
	}
	
    /**
     * Set packLimit
     *
     * @param bool $packLimit
     * @return User
     */
    public function setPackLimit($packLimit) {
        $this->PackLimit = $packLimit;
        return $this;
    }

    /**
     * Get packLimit
     *
     * @return bool 
     */
    public function getPackLimit() {
        return $this->PackLimit;
    }

    /**
     * Set isVerified
     *
     * @param bool $isVerified
     * @return User
     */
    public function setIsVerified($isVerified) {
        $this->IsVerified = $isVerified == TRUE;
        return $this;
    }

    /**
     * Get isVerified
     *
     * @return bool 
     */
    public function getIsVerified() {
        return $this->IsVerified;
    }

    /**
     * Set isPremium
     *
     * @param bool $isPremium
     * @return User
     */
    public function setIsPremium($isPremium) {
        $this->IsPremium = $isPremium == TRUE;
        return $this;
    }

    /**
     * Get isPremium
     *
     * @return bool 
     */
    public function getIsPremium() {
        return $this->IsPremium;
    }

    /**
     * Set hasAppPackUpdates
     *
     * @param bool $hasAppPackUpdates
     * @return User
     */
    public function setHasAppPackUpdates($hasAppPackUpdates) {
        $this->HasAppPackUpdates = $hasAppPackUpdates == TRUE;
        return $this;
    }

    /**
     * Get hasAppPackUpdates
     *
     * @return bool 
     */
    public function getHasAppPackUpdates() {
        return $this->HasAppPackUpdates;
    }

    /**
     * Set hasAppSiteUpdates
     *
     * @param bool $hasAppSiteUpdates
     * @return User
     */
    public function setHasAppSiteUpdates($hasAppSiteUpdates) {
        $this->HasAppSiteUpdates = $hasAppSiteUpdates == TRUE;
        return $this;
    }

    /**
     * Get hasAppSiteUpdates
     *
     * @return bool 
     */
    public function getHasAppSiteUpdates() {
        return $this->HasAppSiteUpdates;
    }

    /**
     * Set hasAppYellowText
     *
     * @param bool $hasAppYellowText
     * @return User
     */
    public function setHasAppYellowText($hasAppYellowText) {
        $this->HasAppYellowText = $hasAppYellowText == TRUE;
        return $this;
    }

    /**
     * Get hasAppYellowText
     *
     * @return bool 
     */
    public function getHasAppYellowText() {
        return $this->HasAppYellowText;
    }

    /**
     * Set hasAppBrowseDetailed
     *
     * @param bool $hasAppBrowseDetailed
     * @return User
     */
    public function setHasAppBrowseDetailed($hasAppBrowseDetailed) {
        $this->HasAppBrowseDetailed = $hasAppBrowseDetailed == TRUE;
        return $this;
    }

    /**
     * Get hasAppBrowseDetailed
     *
     * @return bool 
     */
    public function getHasAppBrowseDetailed() {
        return $this->HasAppBrowseDetailed;
    }

    /**
     * Set creationDate
     *
     * @param int $creationDate
     * @return User
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
     * @return User
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

	/**
	 * Get texturePackPermissions
	 * 
	 * @return array
	 */
	public function getTexturePackPermissions() {
		return $this->_texturePackPermissions;
	}
	
	/**
	 * Add texturePackPermission
	 * 
	 * @param TexturePack $texturePack
	 * @param Permission $permission
	 * @return User
	 */
	public function addTexturePackPermission($texturePack, $permission) {
		$this->_texturePackPermissions[$texturePack->getID()][$permission->getCode()] = $permission;
	}

	/**
	 * Get texturePacks
	 *
	 * @return array
	 */
	public function getTexturePacks() {
		return $this->_texturePacks;
	}

	/**
	 * Add texturePack
	 *
	 * @param TexturePack $texturePack
	 * @return User
	 */
	public function addTexturePack($texturePack) {
		$this->_texturePacks[$texturePack->getID()] = $texturePack;
	}

	/**
	 * Get favoritePackEntries
	 *
	 * @return array
	 */
	public function getFavoritePacks() {
		return $this->_favoritePacks;
	}

	/**
	 * Add favoritePack
	 *
	 * @param User_TexturePack_favorite $favoritePack
	 * @return User
	 */
	public function addFavoritePack($favoritePack) {
		$this->_favoritePacks[$favoritePack->getTexturePackID()] = $favoritePack;
	}
}