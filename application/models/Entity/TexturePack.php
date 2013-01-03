<?php

namespace Entity; 

require_once('application/models/Entity/Entity.php');

class TexturePack extends Entity {

	protected static $_propertyNames;
	
	
    /** @var int $ID */
    protected $ID;

	/** @var int $UserID */
	protected $UserID;
	/** @var User $User */
	protected $_User;
	
	/** @var int $GameResolutionID */
	protected $GameResolutionID;
	/** @var GameResolution $GameResolution */
	protected $_GameResolution;
	
	/** @var int $GameVersionID */
	protected $GameVersionID;
	/** @var GameVersion $GameVersion */
	protected $_GameVersion;
	
    /** @var string $Name */
    protected $Name;

    /** @var string $Version */
	protected $Version;

    /** @var int $DownloadCount */
	protected $DownloadCount;

    /** @var int $FavoriteCount */
	protected $FavoriteCount;

    /** @var int $ViewCount */
	protected $ViewCount;

    /** @var int $TextureCount */
	protected $TextureCount;

    /** @var bool $CompletePercent */
	protected $CompletePercent;

    /** @var float $Customizability */
	protected $Customizability;

    /** @var string $SiteEpithet */
    protected $SiteEpithet;

    /** @var string $GameEpithet */
	protected $GameEpithet;

    /** @var string $Chronicle */
	protected $Chronicle;

    /** @var string $Notes */
	protected $Notes;

    /** @var int $AdflyID */
	protected $AdflyID;

    /** @var int $AdflyCutPercent */
	protected $AdflyCutPercent;

    /** @var bool $IsEnabled */
	protected $IsEnabled;

    /** @var bool $IsOfficial */
	protected $IsOfficial;

    /** @var bool $IsBrowsable */
	protected $IsBrowsable;

    /** @var bool $IsCombinable */
	protected $IsCombinable;

    /** @var bool $IsProtected */
	protected $IsProtected;

    /** @var bool $ShouldUseCustomSections */
	protected $ShouldUseCustomSections;

    /** @var bool $HasCommenting */
	protected $HasCommenting;

    /** @var bool $HasDownloadCustomResolution */
	protected $HasDownloadCustomResolution;

    /** @var bool $HasDownloadCustomEpithet */
	protected $HasDownloadCustomEpithet;

    /** @var bool $HasDownloadAdfly */
	protected $HasDownloadAdfly;

    /** @var bool $HasDownloadAdflyForced */
	protected $HasDownloadAdflyForced;

	/** @var int $LastTextureUploadDate */
	protected $LastTextureUploadDate;
	
    /** @var int $CreationDate */
	protected $CreationDate;

    /** @var int $EditDate */
	protected $EditDate;
	
	
	/** @var array $_customizerSections */
	protected $_customizerSections = array();

	/** 
	 * Stored as a multidimensional array indexed by TextureDefinitionID
	 * @var array $_textures
	 */
	protected $_textures = array();
	
	
	
    /**
     * Get ID
     *
     * @return int 
     */
    public function getID() {
        return $this->ID;
    }

	/**
	 * Set userID
	 *
	 * @param int $userID
	 * @return TexturePack
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
	 * Set user
	 *
	 * @param User $user
	 * @return TexturePack
	 */
	public function setUser($user) {
		$this->_User = $user;
		return $this;
	}

	/**
	 * Get user
	 *
	 * @return User
	 */
	public function getUser() {
		return $this->_User;
	}
	
	/**
	 * Set gameResolutionID
	 *
	 * @param int $gameResolutionID
	 * @return TexturePack
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
	 * Set gameResolution
	 *
	 * @param GameResolution $gameResolution
	 * @return TexturePack
	 */
	public function setGameResolution($gameResolution) {
		$this->_GameResolution = $gameResolution;
		return $this;
	}

	/**
	 * Get gameResolution
	 *
	 * @return GameResolution
	 */
	public function getGameResolution() {
		return $this->_GameResolution;
	}

	/**
	 * Set gameVersionID
	 *
	 * @param int $gameVersionID
	 * @return TexturePack
	 */
	public function setGameVersionID($gameVersionID) {
		$this->GameVersionID = intval($gameVersionID);
		return $this;
	}

	/**
	 * Get gameVersionID
	 *
	 * @return int
	 */
	public function getGameVersionID() {
		return $this->GameVersionID;
	}

	/**
	 * Set gameVersion
	 *
	 * @param GameVersion $gameVersion
	 * @return TexturePack
	 */
	public function setGameVersion($gameVersion) {
		$this->_GameVersion = $gameVersion;
		return $this;
	}

	/**
	 * Get gameVersion
	 *
	 * @return GameVersion
	 */
	public function getGameVersion() {
		return $this->_GameVersion;
	}
	
    /**
     * Set name
     *
     * @param string $name
     * @return TexturePack
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
     * Set version
     *
     * @param string $version
     * @return TexturePack
     */
    public function setVersion($version) {
        $this->Version = $version;
        return $this;
    }

    /**
     * Get version
     *
     * @return string 
     */
    public function getVersion() {
        return $this->Version;
    }

    /**
     * Set downloadCount
     *
     * @param int $downloadCount
     * @return TexturePack
     */
    public function setDownloadCount($downloadCount) {
        $this->DownloadCount = intval($downloadCount);
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
     * @return TexturePack
     */
    public function setFavoriteCount($favoriteCount) {
        $this->FavoriteCount = intval($favoriteCount);
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
     * Set viewCount
     *
     * @param int $viewCount
     * @return TexturePack
     */
    public function setViewCount($viewCount) {
        $this->ViewCount = intval($viewCount);
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
     * Set textureCount
     *
     * @param int $textureCount
     * @return TexturePack
     */
    public function setTextureCount($textureCount) {
        $this->TextureCount = intval($textureCount);
        return $this;
    }

    /**
     * Get textureCount
     *
     * @return int 
     */
    public function getTextureCount() {
        return $this->TextureCount;
    }

    /**
     * Set completePercent
     *
     * @param int $percentComplete
     * @return TexturePack
     */
    public function setCompletePercent($percentComplete) {
        $this->CompletePercent = intval($percentComplete);
        return $this;
    }

    /**
     * Get completePercent
     *
     * @return int 
     */
    public function getCompletePercent() {
        return $this->CompletePercent;
    }

    /**
     * Set customizability
     *
     * @param float $customizability
     * @return TexturePack
     */
    public function setCustomizability($customizability) {
        $this->Customizability = floatval($customizability);
        return $this;
    }

    /**
     * Get customizability
     *
     * @return float 
     */
    public function getCustomizability() {
        return $this->Customizability;
    }

    /**
     * Set siteEpithet
     *
     * @param string $siteEpithet
     * @return TexturePack
     */
    public function setSiteEpithet($siteEpithet) {
        $this->SiteEpithet = $siteEpithet;
        return $this;
    }

    /**
     * Get siteEpithet
     *
     * @return string 
     */
    public function getSiteEpithet() {
        return $this->SiteEpithet;
    }

    /**
     * Set gameEpithet
     *
     * @param string $gameEpithet
     * @return TexturePack
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
     * Set chronicle
     *
     * @param string $chronicle
     * @return TexturePack
     */
    public function setChronicle($chronicle) {
        $this->Chronicle = $chronicle;
        return $this;
    }

    /**
     * Get chronicle
     *
     * @return string 
     */
    public function getChronicle() {
        return $this->Chronicle;
    }

    /**
     * Set notes
     *
     * @param string $notes
     * @return TexturePack
     */
    public function setNotes($notes) {
        $this->Notes = $notes;
        return $this;
    }

    /**
     * Get notes
     *
     * @return string 
     */
    public function getNotes() {
        return $this->Notes;
    }

    /**
     * Set adflyID
     *
     * @param int $adflyID
     * @return TexturePack
     */
    public function setAdflyID($adflyID) {
        $this->AdflyID = intval($adflyID);
        return $this;
    }

    /**
     * Get adflyID
     *
     * @return int 
     */
    public function getAdflyID() {
        return $this->AdflyID;
    }

    /**
     * Set adflyCutPercent
     *
     * @param bool $adflyCutPercent
     * @return TexturePack
     */
    public function setAdflyCutPercent($adflyCutPercent) {
        $this->AdflyCutPercent = intval($adflyCutPercent);
        return $this;
    }

    /**
     * Get adflyCutPercent
     *
     * @return bool 
     */
    public function getAdflyCutPercent() {
        return $this->AdflyCutPercent;
    }

    /**
     * Set isEnabled
     *
     * @param bool $isEnabled
     * @return TexturePack
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
     * Set isOfficial
     *
     * @param bool $isOfficial
     * @return TexturePack
     */
    public function setIsOfficial($isOfficial) {
        $this->IsOfficial = $isOfficial == TRUE;
        return $this;
    }

    /**
     * Get isOfficial
     *
     * @return bool 
     */
    public function getIsOfficial() {
        return $this->IsOfficial;
    }

    /**
     * Set isBrowsable
     *
     * @param bool $isBrowsable
     * @return TexturePack
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
     * @return TexturePack
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
     * Set isProtected
     *
     * @param bool $isProtected
     * @return TexturePack
     */
    public function setIsProtected($isProtected) {
        $this->IsProtected = $isProtected == TRUE;
        return $this;
    }

    /**
     * Get isProtected
     *
     * @return bool 
     */
    public function getIsProtected() {
        return $this->IsProtected;
    }

    /**
     * Set shouldUseCustomSections
     *
     * @param bool $shouldUseCustomSections
     * @return TexturePack
     */
    public function setShouldUseCustomSections($shouldUseCustomSections) {
        $this->ShouldUseCustomSections = $shouldUseCustomSections == TRUE;
        return $this;
    }

    /**
     * Get shouldUseCustomSections
     *
     * @return bool 
     */
    public function getShouldUseCustomSections() {
        return $this->ShouldUseCustomSections;
    }

    /**
     * Set hasCommenting
     *
     * @param bool $hasCommenting
     * @return TexturePack
     */
    public function setHasCommenting($hasCommenting) {
        $this->HasCommenting = $hasCommenting == TRUE;
        return $this;
    }

    /**
     * Get hasCommenting
     *
     * @return bool 
     */
    public function getHasCommenting() {
        return $this->HasCommenting;
    }

    /**
     * Set hasDownloadCustomResolution
     *
     * @param bool $hasDownloadCustomResolution
     * @return TexturePack
     */
    public function setHasDownloadCustomResolution($hasDownloadCustomResolution) {
        $this->HasDownloadCustomResolution = $hasDownloadCustomResolution == TRUE;
        return $this;
    }

    /**
     * Get hasDownloadCustomResolution
     *
     * @return bool 
     */
    public function getHasDownloadCustomResolution() {
        return $this->HasDownloadCustomResolution;
    }

    /**
     * Set hasDownloadCustomEpithet
     *
     * @param bool $hasDownloadCustomEpithet
     * @return TexturePack
     */
    public function setHasDownloadCustomEpithet($hasDownloadCustomEpithet) {
        $this->HasDownloadCustomEpithet = $hasDownloadCustomEpithet == TRUE;
        return $this;
    }

    /**
     * Get hasDownloadCustomEpithet
     *
     * @return bool 
     */
    public function getHasDownloadCustomEpithet() {
        return $this->HasDownloadCustomEpithet;
    }

    /**
     * Set hasDownloadAdfly
     *
     * @param bool $hasDownloadAdfly
     * @return TexturePack
     */
    public function setHasDownloadAdfly($hasDownloadAdfly) {
        $this->HasDownloadAdfly = $hasDownloadAdfly == TRUE;
        return $this;
    }

    /**
     * Get hasDownloadAdfly
     *
     * @return bool 
     */
    public function getHasDownloadAdfly() {
        return $this->HasDownloadAdfly;
    }

    /**
     * Set hasDownloadAdflyForced
     *
     * @param bool $hasDownloadAdflyForced
     * @return TexturePack
     */
    public function setHasDownloadAdflyForced($hasDownloadAdflyForced) {
        $this->HasDownloadAdflyForced = $hasDownloadAdflyForced == TRUE;
        return $this;
    }

    /**
     * Get hasDownloadAdflyForced
     *
     * @return bool 
     */
    public function getHasDownloadAdflyForced() {
        return $this->HasDownloadAdflyForced;
    }

	/**
	 * Set lastTextureUploadDate
	 *
	 * @param int $lastTextureUploadDate
	 * @return TexturePack
	 */
	public function setLastTextureUploadDate($lastTextureUploadDate) {
		$this->LastTextureUploadDate = $lastTextureUploadDate;
		return $this;
	}

	/**
	 * Get lastTextureUploadDate
	 *
	 * @return int
	 */
	public function getLastTextureUploadDate() {
		return $this->LastTextureUploadDate;
	}

    /**
     * Set creationDate
     *
     * @param int $creationDate
     * @return TexturePack
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
     * @return TexturePack
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
	 * Add CustomizerSection
	 * 
	 * @param CustomizerSection $customizerSection
	 * 
	 * @return TexturePack
	 */
	public function addCustomizerSection(CustomizerSection $customizerSection) {
		$this->_customizerSections[$customizerSection->getID()] = $customizerSection;
	}

	/**
	 * Get customizerSections
	 *
	 * @return array
	 */
	public function getCustomizerSections() {
		return $this->_customizerSections;
	}

	/**
	 * Add Texture
	 *
	 * @param Texture $texture
	 *
	 * @return TexturePack
	 */
	public function addTexture(Texture $texture) {
		$this->_textures[$texture->getTextureDefinitionID()][] = $texture;
	}

	/**
	 * Get textures
	 *
	 * @return array
	 */
	public function getTextures() {
		return $this->_textures;
	}
}