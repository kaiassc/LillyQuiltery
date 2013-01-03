<?php
/**
 * Created by Brad Walker on 9/18/12 at 9:50 PM
*/ 

class Error {
	
	// general
	const MissingParameters = 1101;
	const Redundancy = 1102;
	const NoResults = 1103;
	const Syntax = 1104;
	const Unknown = 1105;
	
	// login / registration
	const UsernamePasswordMismatch = 1201;
	const InvalidUsername = 1202;
	const InvalidPassword = 1203;
	const InvalidEmail = 1204;
	const VerifiedPasswordMismatch = 1205;
	const VerifiedEmailMismatch = 1206;
	const InvalidLoginCookie = 1207;
	const ExistingUsername = 1208;
	const ExistingEmail = 1209;
	const UnverifiedAccount = 1210;

	const SQLUnknown = 1301;
	const SQLInsert = 1302;
	const SQLUpdate = 1303;
	
	const APIInvalidField = 1401;
	const APIConfig = 1402;
	const APIInvalidType = 1403;
	const APIInvalidValue = 1404;
	
	private static $errorCodeDescriptions = array(
		self::MissingParameters => 'Required values are missing',
		self::Redundancy => 'Redundant values were found',
		self::NoResults => 'No results were found',
		self::Syntax => 'There was a syntax error with your request',
		self::Unknown => 'Unknown error occurred',
		
		self::UsernamePasswordMismatch => 'That username and password do not match',
		self::InvalidUsername => 'Usernames must be between 4 and 20 characters and can only contain alphanumeric characters, dashes, underscores, or spaces',
		self::InvalidPassword => 'Passwords must be between 6 and 100 characeters',
		self::InvalidEmail => 'That is not a valid email',
		self::VerifiedPasswordMismatch => 'The specified password and verified password do not match',
		self::VerifiedEmailMismatch => 'The specified email and verified email do not match',
		self::InvalidLoginCookie => 'Login cookie is invalid. Try logging in again.',
		self::ExistingUsername => 'That username is already taken',
		self::ExistingEmail => 'That email has already been used',
		self::UnverifiedAccount => 'Your account has not yet been verified by email',

		self::SQLUnknown => 'An unknown database error occurred',
		self::SQLInsert => 'There was an error updating the database',
		self::SQLUpdate => 'There was an error updating the database',
		
		self::APIInvalidField => 'There is an invalid field specified in the URL',
		self::APIConfig => 'The API is not configured correctly. Please notify a site admin ASAP',
		self::APIInvalidType => 'There is a type conflict in one of the query parameters',
		self::APIInvalidValue => 'There is an invalid value in one of the query parameters'
	);

	
	
	
	
	
	/** @var int $code */
	protected $code;

	/** @var string $specificDescription */
	protected $specificDescription;
	
	
	public function __construct($code, $specificDescription = NULL) {
		$this->code = $code;
		$this->specificDescription = $specificDescription;
	}

	
	/**
	 * the error code specific to the error
	 * @return int
	 */
	public function getCode() {
		return $this->code;
	}

	/**
	 * returns a description of the error including generic description and specific description (if any)
	 * @return string
	 */
	public function getDescription($withSpecifics = FALSE) {
		$description = isset(self::$errorCodeDescriptions[$this->code]) ? self::$errorCodeDescriptions[$this->code].'.' : 'DESCRIPTION NOT SET';
		
		if ($withSpecifics) {
			$description .= " {$this->specificDescription}.";
		}
		
		return $description;
	}

	/**
	 * returns a description of the error including error code, generic description, and specific description (if any)
	 * @return string
	 */
	public function getFullDescription() {
		$errorCode = $this->code;
		$genericDescription = isset(self::$errorCodeDescriptions[$this->code]) ? self::$errorCodeDescriptions[$this->code] : 'DESCRIPTION NOT SET';
		$specificDescription = isset($this->specificDescription) ? $this->specificDescription : '';

		return "Error {$errorCode}: {$genericDescription}." . (strlen($specificDescription) > 0 ? " {$specificDescription}." : '');
	}
}
