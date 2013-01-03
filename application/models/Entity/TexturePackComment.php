<?php

namespace Entity; 

require_once('application/models/Entity/Entity.php');

class TexturePackComment extends Entity {

	protected static $_propertyNames;
	
	
    /** @var int $ID */
    protected $ID;

	/** @var int $TexturePackID */
	protected $TexturePackID;

	/** @var int $UserID */
	protected $UserID;
	
    /** @var string $Message */
    protected $Message;

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
	 * @return TexturePackComment
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
	 * @return TexturePackComment
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
     * Set message
     *
     * @param string $message
     * @return TexturePackComment
     */
    public function setMessage($message) {
        $this->Message = $message;
        return $this;
    }

    /**
     * Get message
     *
     * @return string 
     */
    public function getMessage() {
        return $this->Message;
    }

    /**
     * Set creationDate
     *
     * @param int $creationDate
     * @return TexturePackComment
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
     * @return TexturePackComment
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