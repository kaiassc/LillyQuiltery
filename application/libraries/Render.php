<?php
/**
 * Created by Brad Walker on 9/3/12 at 5:24 PM
 */

if (!defined('BASEPATH')) 
	exit('No direct script access allowed');



require_once('application/libraries/Library.php');
require_once('application/models/Entity/TexturePack.php');
require_once('application/models/Entity/GameVersion.php');
require_once('application/models/Entity/GameResolution.php');
require_once('application/models/Entity/CustomizerSection.php');
require_once('application/models/Entity/CustomizerPicker.php');
require_once('application/models/Entity/TextureDefinition.php');
require_once('application/models/Entity/Texture.php');

class Render extends Library {
	
	const AD_LEADERBOARD = 1;
	const AD_MEDIUM_SQUARE = 2;
	const AD_WIDE_SKYSCRAPER = 3;
	const AD_PACK_CHRONICLE_FOOTER = 4;
	const AD_CUSTOMIZER_FOOTER = 5;
	const AD_VERTICAL_MEDIUM = 6;
	
	const _maxSectionIconsPerRow = 20;
		
	/**
	 * @param int $adType an ad type constant specifying which ad to display
	 * @param array $attributes
	 * @return string
	 */
	public function advertisement($adType, $attributes = NULL) {
		$attributes['class'] = 'ad'.(isset($attributes) && isset($attributes['class']) ? ' '.trim($attributes['class']) : '');
		
		switch ($adType) {
			case self::AD_LEADERBOARD:
				$attributes['class'] = "leaderboard {$attributes['class']}";
				$attributeString = $this->getAttributeString($attributes);
				
				return "<div{$attributeString}><script type='text/javascript'><!--
				google_ad_client='ca-pub-6955501016478014';google_ad_slot='0295148284';google_ad_width=728; google_ad_height=90;//--></script><script type='text/javascript' src='http://pagead2.googlesyndication.com/pagead/show_ads.js'></script></div>";
				break;
			
			case self::AD_MEDIUM_SQUARE:
				break;
			
			case self::AD_WIDE_SKYSCRAPER:
				$attributes['class'] = "wideSkyscraper {$attributes['class']}";
				$attributeString = $this->getAttributeString($attributes);

				return "<div{$attributeString}><script type='text/javascript'><!--
				google_ad_client='ca-pub-6955501016478014';google_ad_slot='2832804819';google_ad_width=160;google_ad_height=600;//--></script><script type='text/javascript' src='http://pagead2.googlesyndication.com/pagead/show_ads.js'> </script></div>";
				break;
			
			case self::AD_PACK_CHRONICLE_FOOTER:
				$attributes['class'] = "horizontalLarge {$attributes['class']}";
				$attributeString = $this->getAttributeString($attributes);
				
				return "<div{$attributeString}><script type='text/javascript'><!--
				google_ad_client='ca-pub-6955501016478014';google_ad_slot='7661626443';google_ad_width=728;google_ad_height=15;//--></script><script type='text/javascript' src='http://pagead2.googlesyndication.com/pagead/show_ads.js'></script></div>";
				break;
			
			case self::AD_CUSTOMIZER_FOOTER:
				$attributes['class'] = "horizontalLarge {$attributes['class']}";
				$attributeString = $this->getAttributeString($attributes);
				
				return "<div{$attributeString}><script type='text/javascript'><!--
				google_ad_client='ca-pub-6955501016478014';google_ad_slot='6998435452';google_ad_width=728;google_ad_height=15;//--></script><script type='text/javascript' src='http://pagead2.googlesyndication.com/pagead/show_ads.js'></script></div>";
				break;
			
			case self::AD_VERTICAL_MEDIUM:
				$attributes['class'] = "verticalMedium {$attributes['class']}";
				$attributeString = $this->getAttributeString($attributes);
				
				return "<div{$attributeString}><script type='text/javascript'><!--
				google_ad_client='ca-pub-6955501016478014';google_ad_slot='4585037089';google_ad_width=160;google_ad_height=90;//--></script><script type='text/javascript' src='http://pagead2.googlesyndication.com/pagead/show_ads.js'></script></div>";
				break;
			
			default:
				break;
		}
		
		return NULL;
	}

	

	/**
	 * @param \Entity\TexturePack $texturePack instance of a TexturePack loaded via Doctrine
	 * @param array $attributes
	 * @return string
	 */
	public function texturePackCustomizer(\Entity\TexturePack $texturePack, $attributes = NULL)  {
		$customizerMaxWidth = self::_maxSectionIconsPerRow * (32 + 5 + 4) + 20 - 5;
		$attributes['class'] = 'tpCustomizer'.(isset($attributes) && isset($attributes['class']) ? ' '.trim($attributes['class']) : '');
		$attributes['style'] = "max-width: {$customizerMaxWidth}px;".(isset($attributes) && isset($attributes['style']) ? ' '.trim($attributes['style']) : '');
		$attributeString = $this->getAttributeString($attributes);
		$customizerHTML = '';
		$sectionsHTML = '';
		$sectionTabsHTML = '';

		/** @var \Entity\CustomizerSection $section */
		foreach ($texturePack->getCustomizerSections() as $customizerSection) {
			$sectionHTML = $this->customizerSection($customizerSection, $texturePack);

			if (strlen($sectionHTML) > 0) {
				$sectionsHTML .= $sectionHTML;

				$sectionTabsHTML .= $this->customizerSectionTab($customizerSection);
			}
		}

		if (strlen($sectionsHTML) > 0 && strlen($sectionTabsHTML) > 0) {
			$ad = $this->advertisement(Render::AD_CUSTOMIZER_FOOTER);

			$customizerHTML .= "<div{$attributeString}><ul class='sectionTabs'>{$sectionTabsHTML}</ul><div class='sectionContainer'>{$sectionsHTML}{$ad}</div></div>";
		}
				
		return $customizerHTML;
	}

		/**
		 * @param \Entity\CustomizerSection $customizerSection instance of a CustomizerSection
		 * @param \Entity\TexturePack getCustomizerPickers instance of a TexturePack
		 * @return string 
		 */
		private function customizerSectionTab(\Entity\CustomizerSection $customizerSection, \Entity\TexturePack $texturePack = NULL) {
			/** @var Resource $resource */
			$resource = $this->currentController->getResource();
			$sectionName = $customizerSection->getName();
			$sectionID = $customizerSection->getID();
			$sectionTabIconImagePath = $resource->sectionTabIcon($customizerSection);
				
			return "<li><a href='#ts-{$sectionID}'><div style='background-image: url({$sectionTabIconImagePath});' title='{$sectionName}'></div></a></li>";	
		}

		/**
		 * @param \Entity\CustomizerSection $customizerSection instance of a CustomizerSection
		 * @param \Entity\TexturePack getCustomizerPickers instance of a TexturePack
		 * @return string
		 */
		private function customizerSection(\Entity\CustomizerSection $customizerSection, \Entity\TexturePack $texturePack) {
			$customizerPickers = $customizerSection->getCustomizerPickers();
			$sectionHTML = '';
			$sectionName = $customizerSection->getName();
			$sectionID = $customizerSection->getID();
			$pickersHTML = '';

			/** @var \Entity\CustomizerPicker $picker */
			foreach($customizerPickers as $customizerPicker) {
				$pickersHTML .= $this->customizerPicker($customizerPicker, $customizerSection, $texturePack);
			}

			if (strlen($pickersHTML) > 0) {
				$sectionHTML = "<div id='ts-{$sectionID}' class='ts'><h3>{$sectionName}</h3>{$pickersHTML}</div>";
			}
	
			return $sectionHTML;
		}

		/**
		 * @param \Entity\CustomizerPicker $customizerPicker instance of a CustomizerPicker
		 * @param \Entity\CustomizerSection $customizerSection instance of a CustomizerSection
		 * @param \Entity\TexturePack getCustomizerPickers instance of a TexturePack
		 * @return string
		 */
		private function customizerPicker(\Entity\CustomizerPicker $customizerPicker, \Entity\CustomizerSection $customizerSection = NULL, \Entity\TexturePack $texturePack) {			
			$textureDefinitions = $customizerPicker->getTextureDefinitions();
			$pickerHTML = '';
			$pickerName = $customizerPicker->getName();
			$textureDefinitions = $customizerPicker->getTextureDefinitions();
			
			$texturesHTML = '';

			/** @var \Entity\TextureDefinition $textureDefinition */
			foreach ($textureDefinitions as $textureDefinition) {
				if (isset($texturePack->getTextures()[$textureDefinition->getID()])) {
					/** @var \Entity\Texture $texture */
					foreach ($texturePack->getTextures()[$textureDefinition->getID()] as $texture) {
						$texturesHTML .= $this->texture($texture);
					}
				}
			}		
			
			if (strlen($texturesHTML) > 0) {
				$pickerHTML = "<div class='tpi'><div><p>{$pickerName}</p><p>[description]</p></div>{$texturesHTML}</div>";
			}
	
			return $pickerHTML;
		}
	
		/**
		 * @param \Entity\Texture $texture instance of a Texture
		 * @param \Entity\CustomizerPicker $customizerPicker instance of a CustomizerPicker
		 * @param \Entity\CustomizerSection $customizerSection instance of a CustomizerSection
		 * @param \Entity\TexturePack $texturePack instance of a TexturePack
		 * @return string
		 */
		private function texture(\Entity\Texture $texture, \Entity\CustomizerPicker $customizerPicker = NULL, \Entity\CustomizerSection $customizerSection = NULL, \Entity\TexturePack $texturePack = NULL) {			
			/** @var Resource $resource */
			/** @var Format $format */
			$resource = $this->currentController->getResource();
			$format = $this->currentController->getFormat();
			
			$displayImagePath = $resource->textureImagePathDisplay($texture);
			$resolution = $format->resolutionFromImagePath($displayImagePath);
			$width = $resolution[0];
			$height = $resolution[1];
			
			return "<div class='tx' style='background-image:url({$displayImagePath});width:{$width}px;height:{$height}px'></div>";
		}
	
	
	public function texturePackImageSlider() {
		
	}
	
	
	public function textureDefinitionDropdown($includeBlank = FALSE, $attributes = NULL) {
		$em = $this->currentController->getDoctrine()->entityManager;
		
		$attributes['class'] = 'txdDropdown'.(isset($attributes) && isset($attributes['class']) ? ' '.trim($attributes['class']) : '');
		if (!isset($attributes['data-placeholder'])) {
			$attributes['data-placeholder'] = 'Choose a texture...';
		}
		$attributeString = $this->getAttributeString($attributes);
		
		$options = '';

		$textureDefinitions = $em->createQuery("SELECT td.name, td.ID, m.name AS modName FROM Entity\TextureDefinition td JOIN td.modification m WHERE m.isEnabled = TRUE ORDER BY m.ordinal, td.name")->getResult();

		$lastMod = NULL;
		
		if ($includeBlank) {
			$options .= '<option>';
		}
		
		/** @var \Entity\TextureDefinition $textureDefinition */
		foreach ($textureDefinitions as $textureDefinitionArray) {
			$id = $textureDefinitionArray['ID'];
			$name = $textureDefinitionArray['name'];
			$mod = $textureDefinitionArray['modName'];
			
			if ($mod != $lastMod) {
				$options .= "<optgroup label='{$mod}'>";
				
				$lastMod = $mod;
			}
			
			$options .= "<option value='{$id}'>{$name}";
		}
		
		return "<select{$attributeString}>{$options}</select>";
	}
	
	
	public function browseFilterSelector($selectedFilterNames = NULL, $attributes = NULL) {
		$pdo = $this->currentController->getPDO();
		
		$attributes['class'] = 'browseFilterSelector'.(isset($attributes) && isset($attributes['class']) ? ' '.trim($attributes['class']) : '');
		if (!isset($attributes['data-placeholder'])) {
			$attributes['data-placeholder'] = 'Choose some filters...';
		}
		if (!isset($attributes['multiple'])) {
			$attributes['multiple'] = 'multiple';
		}
		$attributeString = $this->getAttributeString($attributes);
		
		// config
		$browseFilterGroups = array(
			array(
				'label' => 'Resolution',
				'field' => 'res',
				'items' => $pdo->query('SELECT ID, Name FROM GameResolution WHERE IsEnabled = 1 ORDER BY Ordinal')->fetchAll(PDO::FETCH_ASSOC)
			),
			array(
				'label' => 'Minecraft Version',
				'field' => 'ver',
				'items' => $pdo->query('SELECT ID, Name FROM GameVersion WHERE IsEnabled = 1 ORDER BY Ordinal')->fetchAll(PDO::FETCH_ASSOC)
			),
			array(
				'label' => 'Mod Support',
				'field' => 'modID',
				'items' => $pdo->query('SELECT ID, Name FROM `Mod` WHERE IsEnabled = 1 ORDER BY Ordinal')->fetchAll(PDO::FETCH_ASSOC),
				'isExclusive' => TRUE
			)
		);
		
		
		$html = "<select{$attributeString}>";

		foreach ($browseFilterGroups as $browseFilterGroup) {
			$label = $browseFilterGroup['label'];
			$field = $browseFilterGroup['field'];
			$exclusive = isset($browseFilterGroup['isExclusive']) && $browseFilterGroup['isExclusive'] ? 1 : 0;
				
			$html .= "<optgroup label='{$label}' data-field='{$field}' data-exclusive='{$exclusive}'>";
			
			$i = 0;
			foreach ($browseFilterGroup['items'] as $item) {
				$itemValue = $item['ID'];
				$itemLabel = $item['Name'];
				$selected = is_array($selectedFilterNames) && in_array($itemLabel, $selectedFilterNames);

				$itemAttributes = array(
					'value' => $itemValue
				);
				if ($selected) {
					$itemAttributes['selected'] = 'selected';
				}
				$itemAttributeString = $this->getAttributeString($itemAttributes);
				
				$html .= "<option{$itemAttributeString}>{$itemLabel}";
				
				$i++;
			}
		}
		
		$html .= '</select>';
		
		return $html;
	}


	public function browseOrderBySelector($attributes = NULL) {
		$attributes['class'] = 'browseOrderBySelector'.(isset($attributes) && isset($attributes['class']) ? ' '.trim($attributes['class']) : '');
		$attributeString = $this->getAttributeString($attributes);

		$html = "<select{$attributeString}>";
		
		$html .= '<option value="dl:DESC">Most downloaded';
		$html .= '<option value="name">Name';

		$html .= '</select>';

		return $html;
	}

	/** 
	 * @param \Entity\User $user instance of a User loaded via Doctrine
	 * @return string
	 */
	public function userAvatar(\Entity\User $user) {
		/** @var Resource $resource */
		$resource = $this->currentController->getResource();
			
		$userID = $user->getID();
		$username = $user->getUsername();
		$imagePath = $resource->userAvatarImagePath($user);

		return "<div class='uAvatar'><a href='user/{$userID}'><img src='{$imagePath}' alt='{$username} avatar' title='{$username}'/></a></div>";
	}
	
	
	
	
	
	
	
	private function getAttributeString($attributes) {
		$attributeString = '';
		
		if (isset($attributes) && is_array($attributes)) {
			foreach ($attributes as $name=>$value) {
				$attributeString .= " {$name}='{$value}'";
			}
		}
		
		return $attributeString;
	}
	
	
}
