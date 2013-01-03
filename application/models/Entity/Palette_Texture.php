<?php

namespace Entity;

require_once('application/models/Entity/Entity.php');

class Palette_Texture extends Entity {

	protected static $_propertyNames;
	
	
	/** @var int $PaletteID */
	protected $PaletteID;

	/** @var int $TextureID */
	protected $TextureID;

	/** @var int $TextureDefinitionID */
	protected $TextureDefinitionID;

    /** @var string $PairedKey */
    protected $PairedKey;


	/**
	 * Set paletteID
	 *
	 * @param int $paletteID
	 * @return Palette
	 */
	public function setPaletteID($paletteID) {
		$this->PaletteID = intval($paletteID);
		return $this;
	}
	
    /**
     * Get paletteID
     *
     * @return int 
     */
    public function getPaletteID() {
        return $this->PaletteID;
    }

	/**
	 * Set textureID
	 *
	 * @param int $textureID
	 * @return Palette
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
	 * Set textureDefinitionID
	 *
	 * @param int $textureDefinitionID
	 * @return Palette
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
     * Set pairedKey
     *
     * @param string $pairedKey
     * @return Palette
     */
    public function setPairedKey($pairedKey) {
        $this->PairedKey = $pairedKey;
        return $this;
    }

    /**
     * Get pairedKey
     *
     * @return string 
     */
    public function getPairedKey() {
        return $this->PairedKey;
    }
}