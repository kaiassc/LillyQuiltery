<?php

namespace Entity;

require_once('application/models/Entity/Entity.php');

class TexturePackAdFormat extends Entity {

	protected static $_propertyNames;
	
	
    /** @var int $ID */
    protected $ID;

	/** @var int $GameResolutionID */
	protected $GameResolutionID;
	
	/** @var int $WeatherID */
	protected $WeatherID;
	
    /** @var string $LayoutRule */
    protected $LayoutRule;

    /** @var float $Scale */
    protected $Scale;

    /** @var int $CreationDate */
    protected $CreationDate;

    /** @var int $EditDate */
    protected $EditDate;

    
    /**
     * Get ID
     *
     * @return int 
     */
    public function getID()
    {
        return $this->ID;
    }

    /**
     * Set layoutRule
     *
     * @param string $layoutRule
     * @return TexturePackAdFormat
     */
    public function setLayoutRule($layoutRule) {
        $this->LayoutRule = $layoutRule;
        return $this;
    }

    /**
     * Get layoutRule
     *
     * @return string 
     */
    public function getLayoutRule() {
        return $this->LayoutRule;
    }

    /**
     * Set scale
     *
     * @param float $scale
     * @return TexturePackAdFormat
     */
    public function setScale($scale) {
        $this->Scale = $scale;
        return $this;
    }

    /**
     * Get scale
     *
     * @return float 
     */
    public function getScale() {
        return $this->Scale;
    }

    /**
     * Set creationDate
     *
     * @param int $creationDate
     * @return TexturePackAdFormat
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
     * @return TexturePackAdFormat
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
     * Set weatherID
     *
     * @param int $weatherID
     * @return TexturePackAdFormat
     */
    public function setWeatherID($weatherID) {
        $this->WeatherID = intval($weatherID);
        return $this;
    }

    /**
     * Get weather
     *
     * @return int 
     */
    public function getWeatherID() {
        return $this->WeatherID;
    }

    /**
     * Set gameResolutionID
     *
     * @param int $gameResolutionID
     * @return TexturePackAdFormat
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
}