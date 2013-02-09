<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

require_once('application/core/PageController.php');

class Pattern_Controller extends PageController {

	/* @var \Resource $resource */
	public $resource;


	/* @var \Entity\Pattern $texturePack */
	public $pattern;

	public function __construct() {
		parent::__construct();

		$this->load->helper('url');

		$this->resource = $this->getResource();
	}

	public function index($patternID = NULL, $patternTitle = NULL) {
		$pdo = $this->getPDO();
		
		if (isset($patternID) && is_numeric($patternID) && intval($patternID) == $patternID) {
			if ($patternID > 0) {
				// fetch pattern
				
				/*
				$packStmt = $pdo->prepare(sprintf('SELECT %s,%s,%s,%s FROM TexturePack tp INNER JOIN User u ON tp.UserID = u.ID INNER JOIN GameVersion gv ON tp.GameVersionID = gv.ID INNER JOIN GameResolution gr ON tp.GameResolutionID = gr.ID WHERE tp.ID = :id',
					\Entity\TexturePack::getAllFields('tp'),
					\Entity\User::getAllFields('u', TRUE),
					\Entity\GameVersion::getAllFields('gv', TRUE),
					\Entity\GameResolution::getAllFields('gr', TRUE)
				));
				*/
				$patternStmt = $pdo->prepare(sprintf('SELECT %s FROM Pattern pat WHERE pat.ID = :id',
					\Entity\Pattern::getAllFields('pat')
				));
				$patternSuccess = $patternStmt->execute(array(
					':id' => $patternID
				));
				
				if (!$patternSuccess) {
					die(implode(' ', $patternStmt->errorInfo()));
				}
				
				$patternResults = $patternStmt->fetchAll(PDO::FETCH_ASSOC);
				
				$patternResultCount = count($patternResults);
				if ($patternResultCount > 1) {
					$error = new Error(Error::Redundancy);
					die($error->getDescription());
				}
				else if ($patternResultCount === 0) {
					die("hey nows");
					show_404();
				}
				
				/* @var \Entity\Pattern $pattern */
				$pattern = \Entity\Pattern::buildFromArray($patternResults[0]);
				
				$correctPatternTitle = $this->format->titleForURL($pattern->getName());
				
				if (!isset($patternTitle) || $patternTitle !== $correctPatternTitle) {
					$correctPatternURL = $this->format->patternURL($pattern);
					
					redirect($correctPatternURL, 'location', 301);
					die();
				}
				
				
				
				/*
				$pattern->setUser(\Entity\User::buildFromArray($packResults[0], 'u'));
				$pattern->setGameVersion(\Entity\GameVersion::buildFromArray($packResults[0], 'gv'));
				$pattern->setGameResolution(\Entity\GameResolution::buildFromArray($packResults[0], 'gr'));
				
				if ($this->userManager->isUserLoggedIn()) {
					// fetch user's permissions on this pack (if any)
					$texturePackPermissionStmt = $pdo->prepare(sprintf('SELECT %s FROM Permission p INNER JOIN TexturePack_Permission_User t_p_u ON t_p_u.PermissionID = p.ID WHERE t_p_u.TexturePackID = :packID AND t_p_u.UserID = :userID',
						\Entity\Permission::getAllFields()
					));
					$texturePackPermissionSuccess = $texturePackPermissionStmt->execute(array(
						':packID' => $texturePack->getID(),
						':userID' => $this->userManager->getLoggedInUser()->getID()
					));
					
					if (!$texturePackPermissionSuccess) {
						die(implode(' ', $texturePackPermissionStmt->errorInfo()));
					}
					
					while ($texturePackPermissionRow = $texturePackPermissionStmt->fetch(PDO::FETCH_ASSOC)) {
						$this->userManager->getLoggedInUser()->addTexturePackPermission($texturePack, \Entity\Permission::buildFromArray($texturePackPermissionRow));
					}
					
					$this->isUsersFavoritePack = isset($this->userManager->getLoggedInUser()->getFavoritePacks()[$texturePack->getID()]);
				}
				
				// fetch customizer
				$customizerStructureStmt = $pdo->prepare(sprintf('SELECT %s, %s, %s FROM CustomizerSection cs INNER JOIN CustomizerPicker cp ON cp.CustomizerSectionID = cs.ID INNER JOIN CustomizerPicker_TextureDefinition cp_td ON cp_td.CustomizerPickerID = cp.ID INNER JOIN TextureDefinition td ON cp_td.TextureDefinitionID = td.ID WHERE cs.TexturePackID %s AND cs.IsEnabled = 1 AND cp.IsEnabled = 1 AND td.IsEnabled = 1 ORDER BY cs.Ordinal, cp.Ordinal, cp_td.Ordinal',
					\Entity\CustomizerSection::getAllFields('cs', TRUE),
					\Entity\CustomizerPicker::getAllFields('cp', TRUE),
					\Entity\TextureDefinition::getAllFields('td', TRUE),
					$texturePack->getShouldUseCustomSections() ? "= {$texturePack->getID()}" : 'IS NULL'
				));
				$customizerStructureSuccess = $customizerStructureStmt->execute(array(
					':id' => $packID
				));

				if (!$customizerStructureSuccess) {
					die(implode(' ', $customizerStructureStmt->errorInfo()));
				}

				while ($customizerStructureRow = $customizerStructureStmt->fetch(PDO::FETCH_ASSOC)) {
					/** @var \Entity\CustomizerSection $customizerSection *
					$customizerSectionID = $customizerStructureRow['csID'];
					if (isset($texturePack->getCustomizerSections()[$customizerSectionID])) {
						$customizerSection = $texturePack->getCustomizerSections()[$customizerSectionID];
					}
					else {
						$customizerSection = \Entity\CustomizerSection::buildFromArray($customizerStructureRow, 'cs');
						$texturePack->addCustomizerSection($customizerSection);
					}

					/** @var \Entity\CustomizerPicker $customizerPicker *
					$customizerPickerID = $customizerStructureRow['cpID'];
					if (isset($customizerSection->getCustomizerPickers()[$customizerPickerID])) {
						$customizerPicker = $customizerSection->getCustomizerPickers()[$customizerPickerID];
					}
					else {
						$customizerPicker = \Entity\CustomizerPicker::buildFromArray($customizerStructureRow, 'cp');
						$customizerSection->addCustomizerPicker($customizerPicker);
					}

					$customizerPicker->addTextureDefinition(\Entity\TextureDefinition::buildFromArray($customizerStructureRow, 'td'));
				}

				$texturesStmt = $pdo->prepare(sprintf('SELECT %s FROM Texture WHERE TexturePackID = :packID ORDER BY Ordinal',
					\Entity\Texture::getAllFields()
				));
				$texturesSuccess = $texturesStmt->execute(array(
					':packID' => $packID
				));

				if (!$texturesSuccess) {
					die(implode(' ', $texturesStmt->errorInfo()));
				}

				while ($textureRow = $texturesStmt->fetch(PDO::FETCH_ASSOC)) {
					$texturePack->addTexture(\Entity\Texture::buildFromArray($textureRow));
				}

				$texturePackUpdateStmt = $pdo->prepare('UPDATE TexturePack SET ViewCount = ViewCount + 1 WHERE ID = :packID');
				$texturePackUpdateSuccess = $texturePackUpdateStmt->execute(array(
					':packID' => $texturePack->getID()
				));
			
				if (!$texturePackUpdateSuccess) {
					$error = new Error(Error::SQLUpdate);
					die($error->getDescription());
				}

				if ($this->isUsersFavoritePack) {
					$favoritePackUpdateStmt = $pdo->prepare('UPDATE User_TexturePack_favorite SET ViewCount = ViewCount + 1, LastViewDate = NOW() WHERE UserID = :userID AND TexturePackID = :packID');
					$favoritePackUpdateSuccess = $favoritePackUpdateStmt->execute(array(
						':userID' => $this->userManager->getLoggedInUser()->getID(),
						':packID' => $texturePack->getID()
					));

					if (!$favoritePackUpdateSuccess) {
						$error = new Error(Error::SQLUpdate);
						die($error->getDescription());
					}
				}
				*/
				
				$this->pattern = $pattern;
			}
		}
		else {
			show_404();
		}

		$this->load->view('_HeaderView');
		$this->load->view('PatternView');
		$this->load->view('_FooterView');
	}

	public function default_() {
		$this->index(1, 'default');
	}
}