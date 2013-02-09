<?php
/**
 * Created by Brad Walker on 9/18/12 at 7:54 PM
*/


if (!defined('BASEPATH'))
	exit('No direct script access allowed');

require_once('application/libraries/Library.php');
require_once('application/objects/Error.php');
require_once('application/models/Entity/User.php');

class UserManager extends Library {

	const LOGIN_COOKIE_KEY      = 'LQ_UserLoginHash';
	const LOGIN_COOKIE_LIFETIME = 30;
	const LOGIN_HASH_LIFETIME   = 90;

	
	/** @var bool $isUserLoggedIn */
	protected $isUserLoggedIn;
	
	/** @var \Entity\User */
	protected $loggedInUser;


	/**
	 * returns the logged in user or FALSE if not logged in
	 * 
	 * @param \Error $error
	 * @return \Entity\User
	 */
	public function getLoggedInUser(&$error = NULL) {
		$pdo = $this->currentController->getPDO();
		
		if (!isset($this->loggedInUser)) {
			$this->isUserLoggedIn = FALSE;

			if (isset($_COOKIE[self::LOGIN_COOKIE_KEY])) {
				$loginHash = $_COOKIE[self::LOGIN_COOKIE_KEY];
				$loginHashLength = strlen($loginHash);

				if ($loginHashLength === 23) {
					$userStmt = $pdo->prepare(sprintf('SELECT tp.ID AS tpID, tp.Name as tpName, %s, %s FROM User u LEFT JOIN TexturePack tp ON u.ID = tp.UserID LEFT JOIN User_TexturePack_favorite u_tp_f ON u.ID = u_tp_f.UserID WHERE u.LoginHash = :loginHash',
						\Entity\User_TexturePack_favorite::getAllFields('u_tp_f', TRUE),
						\Entity\User::getAllFields('u', TRUE)
					));

					$userSuccess = $userStmt->execute(array(
						':loginHash' => $loginHash
					));

					if (!$userSuccess) {
						$error = new Error(Error::SQLUnknown, implode(' ', $userStmt->errorInfo()));
						return FALSE;
					}

					$usersResult = $userStmt->fetchAll(PDO::FETCH_ASSOC);
					
					if (count($usersResult) == 0) {
						return FALSE;
					}
					
					/** @var \Entity\User $user  */
					$user = \Entity\User::buildFromArray($usersResult[0], 'u');
					$usersTexturePacks = $user->getTexturePacks();
					$usersFavoritePacks = $user->getFavoritePacks();
					
					foreach ($usersResult as $usersResultRow) {
						if (!isset($usersTexturePacks) || !isset($usersTexturePacks[$usersResultRow['tpID']])) {
							/** \Entity\TexturePack $texturePack */
							$texturePack = \Entity\TexturePack::buildFromArray($usersResultRow, 'tp');

							if ($texturePack) {
								$user->addTexturePack($texturePack);
							}
						}
						if (!isset($usersFavoritePacks) || !isset($usersFavoritePacks[$usersResultRow['u_tp_fTexturePackID']])) {
							/** \Entity\User_TexturePack_favorite $favoritePack */
							$favoritePack = \Entity\User_TexturePack_favorite::buildFromArray($usersResultRow, 'u_tp_f');

							if ($favoritePack) {
								$user->addFavoritePack($favoritePack);
							}
						}
					}

					if (time() >= strtotime($user->getLoginHashExpirationDate())) {
						$this->isUserLoggedIn = FALSE;
						$this->loggedInUser = NULL;
					}
					else {
						$this->isUserLoggedIn = TRUE;
						$this->loggedInUser = $user;
					}
				}
				else if ($loginHashLength > 0) {
					// clean up cookie
					$this->logoutUser();
					
					$error = new \Error(Error::InvalidLoginCookie);
					
					return FALSE;
				}
			}
		}
		
		return $this->loggedInUser;
	}

	/**
	 * returns TRUE if there is a valid logged in user
	 * 
	 * @return bool 
	 */
	public function isUserLoggedIn() {
		if (!isset($this->isUserLoggedIn)) {
			$this->getLoggedInUser();
		}
		
		return $this->isUserLoggedIn;
	}

	/**
	 * logs in the user with the provided credentials
	 * @param string $username the username to log in
	 * @param string $password the unencrypted password to use for the log in
	 * @param Error $error populated with the login error if any
	 * @return bool
	 */
	public function loginUser($username, $password, &$error = NULL) {
		$pdo = $this->currentController->getPDO();
		$format = $this->currentController->getFormat();
		
		$userStmt = $pdo->prepare(sprintf('SELECT %s FROM User WHERE Username = :username AND Password = :password',
			\Entity\User::getAllFields()
		));
		$userSuccess = $userStmt->execute(array(
			':username' => $username,
			':password' => $format->passwordHash($password)
		));
		
		if (!$userSuccess) {
			$error = new \Error(Error::SQLUnknown, implode(' ', $userStmt->errorInfo()));
			return FALSE;
		}
		
		$result = $userStmt->fetchAll(\PDO::FETCH_CLASS, 'Entity\User');
		
		if (count($result) == 0) {
			$error = new Error(Error::UsernamePasswordMismatch);
			return FALSE;
		}
		else if (count($result) > 1) {
			$error = new Error(Error::Redundancy);
			return FALSE;
		}
		
		/** @var \Entity\User $user */
		$user = $result[0];
		
		if (!$user->getIsVerified()) {
			$error = new Error(Error::UnverifiedAccount);
			return FALSE;
		}
		
		// If hash is expired or invalid then create a new one and reset expiration
		if (time() > $user->getLoginHash() || strlen($user->getLoginHashExpirationDate()) != 23) {
			$user->setLoginHash(uniqid('', TRUE));

			$hashExpirationDate = date('Y-m-d H:i:s', time() + 3600 * 24 * self::LOGIN_HASH_LIFETIME);
			$user->setLoginHashExpirationDate($hashExpirationDate);

			$updateStmt = $pdo->prepare('UPDATE User SET LoginHash = :loginHash, LoginHashExpirationDate = :loginHashExpirationDate WHERE ID = :id');
			$updateSuccess = $updateStmt->execute(array(
				':loginHash' => $user->getLoginHash(),
				':loginHashExpirationDate' => $user->getLoginHashExpirationDate(),
				':id' => $user->getID()
			));
			
			if (!$updateSuccess) {
				$error = new \Error(Error::SQLUnknown, implode(' ', $updateStmt->errorInfo()));
				return FALSE;
			}
		}

		$cookieExpiration = time() + 3600 * 24 * self::LOGIN_COOKIE_LIFETIME;
		setcookie(self::LOGIN_COOKIE_KEY, $user->getLoginHash(), $cookieExpiration, '/');

		$this->isUserLoggedIn = TRUE;
		$this->loggedInUser = $user;
		
		return TRUE;
	}

	/**
	 * logs out the currently logged in user
	 * @return void
	 */
	public function logoutUser() {
		unset($this->loggedInUser);
		$this->isUserLoggedIn = FALSE;
		
		setcookie(self::LOGIN_COOKIE_KEY, '', time() - 3600, '/');
		setcookie(self::LOGIN_COOKIE_KEY, '', time() - 3600, '/');
		setcookie(self::LOGIN_COOKIE_KEY, '', time() - 3600);
	}

	/**
	 * creates a new user
	 * @param string
	 * @param string
	 * @param string
	 * @param string
	 * @param string
	 * @param Error
	 * @return mixed
	 */
	public function createUser($username, $password, $email, &$error = NULL) {
		$pdo = $this->currentController->getPDO();
		$format = $this->currentController->getFormat();
		$validate = $this->currentController->getValidate();
		
		if (!$validate->username($username, FALSE)) {
			$error = new \Error(Error::InvalidUsername);
			return FALSE;
		}
		if (!$validate->password($password)) {
			$error = new \Error(Error::InvalidPassword);
			return FALSE;
		}
		if (!$validate->email($email, FALSE)) {
			$error = new \Error(Error::InvalidEmail);
			return FALSE;
		}
		
		$existingStmt = $pdo->prepare('SELECT Username, Email FROM User WHERE Username = :username OR Email = :email');
		$existingSuccess = $existingStmt->execute(array(
			':username' => $username,
			':email' => $email
		));
		
		if (!$existingSuccess) {
			$error = new \Error(Error::SQLUnknown, implode(' ', $existingStmt->errorInfo()));
			return FALSE;
		}

		$existingUsers = $existingStmt->fetchAll(PDO::FETCH_ASSOC);

		if (count($existingUsers) > 0) {
			if ($existingUsers[0]['Username'] == $username) {
				$error = new \Error(Error::ExistingUsername);
				return FALSE;
			}
			else if ($existingUsers[0]['Email'] == $email) {
				$error = new \Error(Error::ExistingEmail);
				return FALSE;
			}
			else {
				$error = new \Error(Error::ExistingUsername);
				return FALSE;
			}
		}
		
		$verificationHash = uniqid();
		
		$stmt = $pdo->prepare('INSERT INTO User(Username, Password, Email, VerificationHash, CreationDate) VALUES(:username, :password, :email, :verificationHash, NOW())');
		$success = $stmt->execute(array(
			':username' => $username, 
			':password' => $format->passwordHash($password), 
			':email'    => $email,
			':verificationHash' => $verificationHash
		));
		
		if (!$success) {
			$error = new \Error(Error::SQLUnknown, implode(' ', $stmt->errorInfo()));
			return FALSE;
		}

		$message = 
			"Thanks for signing up!
			Your account has been created, you can login with the following credentials after you have activated your account by clicking the link below.
			------------------------
			Username: {$username}
			------------------------
			Please click this link to activate your account:
			http://minecraftcustomizer.net/verify/{$verificationHash}/{$email}";
		
		mail($email, "Verify your Minecraft Customizer account", $message); // "From: Minecraft Customizer <noreply@minecraftcustomizer.net>\r\n"

		return $pdo->lastInsertId();
	}
}
