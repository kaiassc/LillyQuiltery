<?php
/**
 * Created by Brad Walker on 9/3/12 at 5:24 PM
 */

if (!defined('BASEPATH')) 
	exit('No direct script access allowed');



require_once('application/libraries/Library.php');
require_once('application/models/Entity/Pattern.php');
require_once('application/models/Entity/Bundle.php');

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
	
	public function browseFilterSelector($selectedFilterNames = NULL, $attributes = NULL) {
		$pdo = $this->currentController->getPDO();

		// config
		$browseFilterGroups = array(
			array(
				'label' => 'Type',
				'field' => 'type',
				'items' => $pdo->query('SELECT ID, Name FROM PatternType')->fetchAll(PDO::FETCH_ASSOC)
			)
		);
		
		$attributes['class'] = 'browseFilterSelector'.(isset($attributes) && isset($attributes['class']) ? ' '.trim($attributes['class']) : '');
		if (!isset($attributes['data-placeholder'])) {
			$attributes['data-placeholder'] = 'Choose some filters...';
		}
		if (!isset($attributes['multiple'])) {
			$attributes['multiple'] = 'multiple';
		}
		$attributeString = $this->getAttributeString($attributes);	
		
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


	public function browseOrderBySelector($selectedName, $attributes = NULL) {
		// config
		$orderByOptions = array(
			'name:ASC' => 'By Name',
			'price:DESC' => 'Highest price',
			'price:ASC' => 'Lowest price',
			'date:DESC' => 'Newest',
			'date:ASC' => 'Oldest'
		);
		
		$selectedName = str_replace('+', ' ', $selectedName);

		$attributes['class'] = 'browseOrderBySelector'.(isset($attributes) && isset($attributes['class']) ? ' '.trim($attributes['class']) : '');
		$attributeString = $this->getAttributeString($attributes);

		$html = "<select{$attributeString}>";

		foreach ($orderByOptions as $value=>$label) {
			$optionAttributes = array('value' => $value);
			if ($selectedName == $label) {
				$optionAttributes['selected'] = 'selected';
			}
			$optionAttributeString = $this->getAttributeString($optionAttributes);
			$html .= "<option{$optionAttributeString}>{$label}";
		}

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
