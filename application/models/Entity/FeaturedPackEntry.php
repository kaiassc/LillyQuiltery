<?php

namespace Entity; 

require_once('application/models/Entity/Entity.php');

class FeaturedPackEntry extends Entity {

	protected static $_propertyNames;
	
	
    /** @var int $ID */
    protected $ID;

	/** @var int $TexturePackID */
	protected $TexturePackID;
	
    /** @var bool $Ordinal */
    protected $Ordinal;

    /** @var int $ClickCount */
    protected $ClickCount;

    /** @var int $CreationDate */
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
	 * @return FeaturedPackEntry
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
     * Set ordinal
     *
     * @param bool $ordinal
     * @return FeaturedPackEntry
     */
    public function setOrdinal($ordinal) {
        $this->Ordinal = intval($ordinal);
        return $this;
    }

    /**
     * Get ordinal
     *
     * @return bool 
     */
    public function getOrdinal() {
        return $this->Ordinal;
    }

    /**
     * Set clickCount
     *
     * @param int $clickCount
     * @return FeaturedPackEntry
     */
    public function setClickCount($clickCount) {
        $this->ClickCount = $clickCount;
        return $this;
    }

    /**
     * Get clickCount
     *
     * @return int 
     */
    public function getClicks() {
        return $this->ClickCount;
    }

    /**
     * Set creationDate
     *
     * @param int $creationDate
     * @return FeaturedPackEntry
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