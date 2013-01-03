<?php

namespace Entity;

require_once('application/models/Entity/Entity.php');

class TexturePackDownload_Texture extends Entity {

	protected static $_propertyNames;
	
	
	/** @var int $TexturePackID */
	protected $TexturePackDownloadID;

	/** @var int $TextureID */
	protected $TextureID;


	/**
	 * Set texturePackDownloadID
	 *
	 * @param int $texturePackDownloadID
	 * @return TexturePackDownload_Texture
	 */
	public function setTexturePackDownloadID($texturePackDownloadID) {
		$this->TexturePackDownloadID = intval($texturePackDownloadID);
		return $this;
	}
	
    /**
     * Get texturePackDownloadID
     *
     * @return int 
     */
    public function getTexturePackDownloadID() {
        return $this->TexturePackDownloadID;
    }

	/**
	 * Set textureID
	 *
	 * @param int $textureID
	 * @return TexturePackDownload_Texture
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
}