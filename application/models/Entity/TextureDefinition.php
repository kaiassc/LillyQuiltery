<?php

namespace Entity; 

require_once('application/models/Entity/Entity.php');

class TextureDefinition extends Entity {

	protected static $_propertyNames;
	
	
    /** @var int $ID */
    protected $ID;

	/** @var int $PaletteDefinitionID */
	protected $PaletteDefinitionID;

	/** @var int $ModID */
	protected $ModID;

	/** @var int $TexturePackID */
	protected $TexturePackID;

	/** @var int $GameVersionID */
	protected $GameVersionID;
	
    /** @var string $Name */
    protected $Name;

    /** @var int $X */
    protected $X;

    /** @var int $Y */
    protected $Y;

    /** @var int $Z */
    protected $Z;

    /** @var int $Width */
    protected $Width;

    /** @var int $Height */
    protected $Height;

    /** @var float $DisplayScale */
    protected $DisplayScale;

    /** @var string $RawParsingRule */
    protected $RawParsingRule;

    /** @var string $DisplayParsingRule */
    protected $DisplayParsingRule;

	/** @var bool $IsEnabled */
	protected $IsEnabled;
	
    /** @var bool $HasDuplicateChecking */
    protected $HasDuplicateChecking;

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
	 * Set paletteDefinitionID
	 *
	 * @param int $paletteDefinitionID
	 * @return TextureDefinition
	 */
	public function setPaletteDefinitionID($paletteDefinitionID) {
		$this->PaletteDefinitionID = intval($paletteDefinitionID);
		return $this;
	}

	/**
	 * Get paletteDefinitionID
	 *
	 * @return int
	 */
	public function getPaletteDefinitionID() {
		return $this->PaletteDefinitionID;
	}

	/**
	 * Set modID
	 *
	 * @param int $modID
	 * @return TextureDefinition
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
	 * Set texturePackID
	 *
	 * @param int $texturePackID
	 * @return TextureDefinition
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
	 * Set gameVersionID
	 *
	 * @param int $gameVersionID
	 * @return TextureDefinition
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
     * Set name
     *
     * @param string $name
     * @return TextureDefinition
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
     * Set x
     *
     * @param int $x
     * @return TextureDefinition
     */
    public function setX($x) {
        $this->X = $x;
        return $this;
    }

    /**
     * Get x
     *
     * @return int 
     */
    public function getX() {
        return $this->X;
    }

    /**
     * Set y
     *
     * @param int $y
     * @return TextureDefinition
     */
    public function setY($y) {
        $this->Y = $y;
        return $this;
    }

    /**
     * Get y
     *
     * @return int 
     */
    public function getY() {
        return $this->Y;
    }

    /**
     * Set z
     *
     * @param int $z
     * @return TextureDefinition
     */
    public function setZ($z) {
        $this->Z = $z;
        return $this;
    }

    /**
     * Get z
     *
     * @return int 
     */
    public function getZ() {
        return $this->Z;
    }

    /**
     * Set width
     *
     * @param int $width
     * @return TextureDefinition
     */
    public function setWidth($width) {
        $this->Width = $width;
        return $this;
    }

    /**
     * Get width
     *
     * @return int 
     */
    public function getWidth() {
        return $this->Width;
    }

    /**
     * Set height
     *
     * @param int $height
     * @return TextureDefinition
     */
    public function setHeight($height) {
        $this->Height = $height;
        return $this;
    }

    /**
     * Get height
     *
     * @return int 
     */
    public function getHeight() {
        return $this->Height;
    }

    /**
     * Set displayScale
     *
     * @param float $displayScale
     * @return TextureDefinition
     */
    public function setDisplayScale($displayScale) {
        $this->DisplayScale = $displayScale;
        return $this;
    }

    /**
     * Get displayScale
     *
     * @return float 
     */
    public function getDisplayScale() {
        return $this->DisplayScale;
    }

    /**
     * Set rawParsingRule
     *
     * @param string $rawParsingRule
     * @return TextureDefinition
     */
    public function setRawParsingRule($rawParsingRule) {
        $this->RawParsingRule = $rawParsingRule;
        return $this;
    }

    /**
     * Get rawParsingRule
     *
     * @return string 
     */
    public function getRawParsingRule() {
        return $this->RawParsingRule;
    }

    /**
     * Set displayParsingRule
     *
     * @param string $displayParsingRule
     * @return TextureDefinition
     */
    public function setDisplayParsingRule($displayParsingRule) {
        $this->DisplayParsingRule = $displayParsingRule;
        return $this;
    }

    /**
     * Get displayParsingRule
     *
     * @return string 
     */
    public function getDisplayParsingRule() {
        return $this->DisplayParsingRule;
    }

	/**
	 * Set isEnabled
	 *
	 * @param bool $isEnabled
	 * @return CustomizerSection
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
     * Set hasDuplicateChecking
     *
     * @param bool $hasDuplicateChecking
     * @return TextureDefinition
     */
    public function setHasDuplicateChecking($hasDuplicateChecking) {
        $this->HasDuplicateChecking = $hasDuplicateChecking == TRUE;
        return $this;
    }

    /**
     * Get hasDuplicateChecking
     *
     * @return bool 
     */
    public function getHasDuplicateChecking() {
        return $this->HasDuplicateChecking;
    }

    /**
     * Set creationDate
     *
     * @param int $creationDate
     * @return TextureDefinition
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
     * @return TextureDefinition
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