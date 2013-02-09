<?php

namespace Entity;

require_once('application/models/Entity/Entity.php');

class User extends Entity {

	protected static $_propertyNames;
	
	
    /** @var int $ID */
    protected $ID;

    /** @var string $username */
    protected $Username;

    /** @var string $password */
	protected $Password;

    /** @var string $email */
    protected $Email;

    /** @var string $loginHash */
	protected $LoginHash;

    /** @var int $loginHashExpirationDate */
	protected $LoginHashExpirationDate;

	/** @var string $VerificationHash */
	protected $VerificationHash;

    /** @var bool $IsVerified */
    protected $IsVerified;

    /** @var int $creationDate */
    protected $CreationDate;

    /** @var int $editDate */
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
     * Set username
     *
     * @param string $username
     * @return User
     */
    public function setUsername($username) {
        $this->Username = $username;
        return $this;
    }

    /**
     * Get username
     *
     * @return string 
     */
    public function getUsername() {
        return $this->Username;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return User
     */
    public function setPassword($password) {
        $this->Password = $password;
        return $this;
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword() {
        return $this->Password;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return User
     */
    public function setEmail($email) {
        $this->Email = $email;
        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail() {
        return $this->Email;
    }

    /**
     * Set loginHash
     *
     * @param string $loginHash
     * @return User
     */
    public function setLoginHash($loginHash) {
        $this->LoginHash = $loginHash;
        return $this;
    }

    /**
     * Get loginHash
     *
     * @return string 
     */
    public function getLoginHash() {
        return $this->LoginHash;
    }

    /**
     * Set loginHashExpirationDate
     *
     * @param int $loginHashExpirationDate
     * @return User
     */
    public function setLoginHashExpirationDate($loginHashExpirationDate) {
        $this->LoginHashExpirationDate = $loginHashExpirationDate;
        return $this;
    }

    /**
     * Get loginHashExpirationDate
     *
     * @return int 
     */
    public function getLoginHashExpirationDate() {
        return $this->LoginHashExpirationDate;
    }

	/**
	 * Set verificationHash
	 *
	 * @param string $verificationHash
	 * @return User
	 */
	public function setVerificationHash($verificationHash) {
		$this->VerificationHash = $verificationHash;
		return $this;
	}

	/**
	 * Get verificationHash
	 *
	 * @return string
	 */
	public function getVerificationHash() {
		return $this->VerificationHash;
	}

    /**
     * Set isVerified
     *
     * @param bool $isVerified
     * @return User
     */
    public function setIsVerified($isVerified) {
        $this->IsVerified = $isVerified == TRUE;
        return $this;
    }

    /**
     * Get isVerified
     *
     * @return bool 
     */
    public function getIsVerified() {
        return $this->IsVerified;
    }

    /**
     * Set creationDate
     *
     * @param int $creationDate
     * @return User
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
     * @return User
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