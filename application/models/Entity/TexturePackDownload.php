<?php

namespace Entity;

require_once('application/models/Entity/Entity.php');

class TexturePackDownload extends Entity {

	protected static $_propertyNames;
	
	
    /** @var int $ID */
    protected $ID;

	/** @var int $TexturePackID */
	protected $TexturePackID;

	/** @var int $UserID */
	protected $UserID;

	/** @var int $GameResolutionID */
	protected $GameResolutionID;

	/** @var string $GameEpithet */
	protected $GameEpithet;
	
    /** @var bool $IsStarred */
    protected $IsStarred;

    /** @var int $LastDownloadDate */
    protected $LastDownloadDate;

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
	 * Set texturePackID
	 *
	 * @param int $texturePackID
	 * @return TexturePackDownload
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
	 * Set userID
	 *
	 * @param int $userID
	 * @return TexturePackDownload
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
	 * Set gameResolutionID
	 *
	 * @param int $gameResolutionID
	 * @return TexturePackDownload
	 */
	public function setGameResolutionID($gameResolutionID) {
		$this->GameResolutionID = intval($gameResolutionID);
		return $this;
	}

	/**
	 * Get gameResolutionID
	 *
	 * @return int
	 */
	public function getGameResolutionID() {
		return $this->GameResolutionID;
	}

	/**
	 * Set gameEpithet
	 *
	 * @param string $gameEpithet
	 * @return TexturePackDownload
	 */
	public function setGameEpithet($gameEpithet) {
		$this->GameEpithet = $gameEpithet;
		return $this;
	}

	/**
	 * Get gameEpithet
	 *
	 * @return string
	 */
	public function getGameEpithet() {
		return $this->GameEpithet;
	}
	
    /**
     * Set isStarred
     *
     * @param bool $isStarred
     * @return TexturePackDownload
     */
    public function setIsStarred($isStarred) {
        $this->IsStarred = $isStarred == TRUE;
        return $this;
    }

    /**
     * Get isStarred
     *
     * @return bool 
     */
    public function getIsStarred() {
        return $this->IsStarred;
    }

    /**
     * Set lastDownloadDate
     *
     * @param int $lastDownloadDate
     * @return TexturePackDownload
     */
    public function setLastDownloadDate($lastDownloadDate) {
        $this->LastDownloadDate = $lastDownloadDate;
        return $this;
    }

    /**
     * Get lastDownloadDate
     *
     * @return int 
     */
    public function getLastDownloadDate() {
        return $this->LastDownloadDate;
    }

    /**
     * Set creationDate
     *
     * @param int $creationDate
     * @return TexturePackDownload
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
     * @return TexturePackDownload
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