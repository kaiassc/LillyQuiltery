<?php

namespace Entity; 

require_once('application/models/Entity/Entity.php');

class TexturePackFlavor extends Entity {

	protected static $_propertyNames;
	
	
    /** @var int $ID */
    protected $ID;

	/** @var int $TexturePackID */
	protected $TexturePackID;
	
    /** @var string $Name */
    protected $Name;

	/** @var int $Ordinal */
	protected $Ordinal;

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
	 * @return TexturePackFlavor
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
     * Set name
     *
     * @param string $name
     * @return TexturePackFlavor
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
	 * Set ordinal
	 *
	 * @param int $ordinal
	 * @return TexturePackFlavor
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
     * Set creationDate
     *
     * @param int $creationDate
     * @return TexturePackFlavor
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
     * @return TexturePackFlavor
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