<?php
/**
 * Created by Brad Walker on 9/25/12 at 4:04 PM
*/

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

require_once('application/libraries/Library.php');

class Validate extends Library {

	/**
	 * @param string $username
	 * @param bool $checkDatabaseForMatch
	 * @return bool
	 */
	public function username($username, $checkDatabaseForMatch = TRUE) {
		$username = trim($username);
		$length = strlen($username);
		
		$isFormatValid = $length >= 4 && $length <= 20 && preg_match("/[^a-zA-Z0-9 _-]/", $username) !== 1;
		
		if (!$checkDatabaseForMatch) {
			return $isFormatValid;
		}

		$pdo = $this->currentController->getPDO();
		
		$stmt = $pdo->prepare('SELECT COUNT(ID) AS "Count" FROM User WHERE Username = :username');
		$stmt->execute(array(':username' => $username));
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		
		return $isFormatValid && intval($result[0]['Count']) === 0;
	}

	/**
	 * @param string $password
	 * @return bool
	 */
	public function password($password) {
		$length = strlen($password);
		return $length >= 6 && $length <= 100;
	}

	/**
	 * @param string $email
	 * @param bool $checkDatabaseForMatch
	 * @return bool
	 */
	public function email($email, $checkDatabaseForMatch = TRUE) {
		$email = trim($email);
		$isFormatValid = preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $email) === 1;
		
		if (!$checkDatabaseForMatch) {
			return $isFormatValid;
		}

		$pdo = $this->currentController->getPDO();

		$stmt = $pdo->prepare('SELECT COUNT(ID) AS "Count" FROM User WHERE Email = :email');
		$stmt->execute(array(':email' => $email));
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

		return $isFormatValid && intval($result[0]['Count']) === 0;
	}
}
