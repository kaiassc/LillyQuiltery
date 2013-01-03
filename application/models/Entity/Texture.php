<?php

namespace Entity;

require_once('application/models/Entity/Entity.php');

class Texture extends Entity {

	protected static $_propertyNames;
	
	
    /** @var int $ID */
    protected $ID;

	/** @var int $TextureDefinitionID */
	protected $TextureDefinitionID;

	/** @var int $TexturePackID */
	protected $TexturePackID;

	/** @var int $UserID */
	protected $UserID;

	/** @var int $GameResolutionID */
	protected $GameResolutionID;
	
    /** @var string $Epithet */
    protected $Epithet;

    /** @var string $RawPath */
    protected $RawPath;

    /** @var string $RawHash */
    protected $RawHash;

	/** @var int $RawWidth */
	protected $RawWidth;

	/** @var int $RawHeight */
	protected $RawHeight;
	
    /** @var int $DisplayWidth */
    protected $DisplayWidth;

    /** @var int $DisplayHeight */
    protected $DisplayHeight;

    /** @var int $DownloadCount */
    protected $DownloadCount;

    /** @var int $FavoriteCount */
    protected $FavoriteCount;

	/** @var int $Ordinal */
    protected $Ordinal;

    /** @var bool $IsBrowsable */
    protected $IsBrowsable;

    /** @var bool $IsCombinable */
    protected $IsCombinable;

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
	 * Set textureDefinitionID
	 *
	 * @param int $textureDefinitionID
	 * @return Texture
	 */
	public function setTextureDefinitionID($textureDefinitionID) {
		$this->TextureDefinitionID = intval($textureDefinitionID);
		return $this;
	}

	/**
	 * Get textureDefinitionID
	 *
	 * @return int
	 */
	public function getTextureDefinitionID() {
		return $this->TextureDefinitionID;
	}

	/**
	 * Set texturePackID
	 *
	 * @param int $texturePackID
	 * @return Texture
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
	 * @return Texture
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
	public function getUserID()  {
		return $this->UserID;
	}

	/**
	 * Set gameResolutionID
	 *
	 * @param int $gameResolutionID
	 * @return Texture
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
     * Set epithet
     *
     * @param string $epithet
     * @return Texture
     */
    public function setEpithet($epithet) {
        $this->Epithet = $epithet;
        return $this;
    }

    /**
     * Get epithet
     *
     * @return string 
     */
    public function getEpithet() {
        return $this->Epithet;
    }

    /**
     * Set rawPath
     *
     * @param string $rawPath
     * @return Texture
     */
    public function setRawPath($rawPath) {
        $this->RawPath = $rawPath;
        return $this;
    }

    /**
     * Get rawPath
     *
     * @return string 
     */
    public function getRawPath() {
        return $this->RawPath;
    }

    /**
     * Set rawHash
     *
     * @param string $rawHash
     * @return Texture
     */
    public function setRawHash($rawHash) {
        $this->RawHash = $rawHash;
        return $this;
    }

    /**
     * Get rawHash
     *
     * @return string 
     */
    public function getRawHash()  {
        return $this->RawHash;
    }

	/**
	 * Set rawWidth
	 *
	 * @param int $rawWidth
	 * @return Texture
	 */
	public function setRawWidth($rawWidth) {
		$this->RawWidth = $rawWidth;
		return $this;
	}

	/**
	 * Get rawWidth
	 *
	 * @return int
	 */
	public function getRawWidth() {
		return $this->RawWidth;
	}

	/**
	 * Set rawHeight
	 *
	 * @param int $rawHeight
	 * @return Texture
	 */
	public function setRawHeight($rawHeight) {
		$this->RawHeight = $rawHeight;
		return $this;
	}

	/**
	 * Get rawHeight
	 *
	 * @return int
	 */
	public function getRawHeight() {
		return $this->RawHeight;
	}

    /**
     * Set displayWidth
     *
     * @param int $displayWidth
     * @return Texture
     */
    public function setDisplayWidth($displayWidth) {
        $this->DisplayWidth = $displayWidth;
        return $this;
    }

    /**
     * Get displayWidth
     *
     * @return int 
     */
    public function getDisplayWidth() {
        return $this->DisplayWidth;
    }

    /**
     * Set displayHeight
     *
     * @param int $displayHeight
     * @return Texture
     */
    public function setDisplayHeight($displayHeight) {
        $this->DisplayHeight = $displayHeight;
        return $this;
    }

    /**
     * Get displayHeight
     *
     * @return int 
     */
    public function getDisplayHeight() {
        return $this->DisplayHeight;
    }

    /**
     * Set downloadCount
     *
     * @param int $downloadCount
     * @return Texture
     */
    public function setDownloadCount($downloadCount) {
        $this->DownloadCount = $downloadCount;
        return $this;
    }

    /**
     * Get downloadCount
     *
     * @return int 
     */
    public function getDownloadCount() {
        return $this->DownloadCount;
    }

    /**
     * Set favoriteCount
     *
     * @param int $favoriteCount
     * @return Texture
     */
    public function setFavoriteCount($favoriteCount) {
        $this->FavoriteCount = $favoriteCount;
        return $this;
    }

    /**
     * Get favoriteCount
     *
     * @return int 
     */
    public function getFavoriteCount() {
        return $this->FavoriteCount;
    }

    /**
     * Set ordinal
     *
     * @param int $ordinal
     * @return Texture
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

    /**
     * Set isBrowsable
     *
     * @param bool $isBrowsable
     * @return Texture
     */
    public function setIsBrowsable($isBrowsable) {
        $this->IsBrowsable = $isBrowsable == TRUE;
        return $this;
    }

    /**
     * Get isBrowsable
     *
     * @return bool 
     */
    public function getIsBrowsable() {
        return $this->IsBrowsable;
    }

    /**
     * Set isCombinable
     *
     * @param bool $isCombinable
     * @return Texture
     */
    public function setIsCombinable($isCombinable) {
        $this->IsCombinable = $isCombinable == TRUE;
        return $this;
    }

    /**
     * Get isCombinable
     *
     * @return bool 
     */
    public function getIsCombinable() {
        return $this->IsCombinable;
    }

    /**
     * Set creationDate
     *
     * @param int $creationDate
     * @return Texture
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
     * @return Texture
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