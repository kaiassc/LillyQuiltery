<?php
/**
 * Created by Brad Walker on 9/24/12 at 3:38 PM
*/ 

namespace Entity; 

require_once('application/models/Entity/Entity.php');

class Entity implements \JsonSerializable {	
	
	public function jsonSerialize() {
		$refClass = new \ReflectionClass($this);
		$defProperties = $refClass->getDefaultProperties();
		$properties = get_object_vars($this);

		$returnObj = new \StdClass;
		
		foreach ($defProperties as $propName=>$defValue) {
			if (substr($propName, 0, 1) === '_')
				continue;
			
			if (isset($properties[$propName])) {
				$propVal = $properties[$propName];

				if (is_object($propVal)) {
					if (count(get_object_vars($propVal)) > 0) {
						//echo strtoupper($propName).' = '.json_encode($propVal).'<br/>';
						$returnObj->$propName = $propVal;
					}
				}
				else {
					if (strlen($propVal) > 0) {
						//echo $propName.' = '.$propVal.'<br/>';
						$returnObj->$propName = $propVal;
					}
				}
			}
		}

		return $returnObj;
	}
	
	/** 
	 *  returns a comma-separated list of each of the database fields of this object
	 * 
	 *  @param string $prefix
	 *  @param bool $shouldRenameField
	 *  @param bool $asArray
	 *  @return mixed
	 * */
	public static function getAllFields($prefix = NULL, $shouldRenameField = FALSE, $asArray = FALSE) {
		$className = get_called_class();
		
		if (!isset($className::$_propertyNames)) {
			$reflectionClass = new \ReflectionClass($className);
			$defaultProperties = $reflectionClass->getDefaultProperties();
			$propertyNames = array();
			
			foreach ($defaultProperties as $propertyName=>$defaultValue) {
				if (substr($propertyName, 0, 1) !== '_') {
					$className::$_propertyNames[] = $propertyName;
				}
			}
		}

		if (isset($prefix) && strlen($prefix) > 0) {
			$pre = $prefix.'.';
		}
		else {
			$pre = '';
		}
		
		$fields = array();
		foreach ($className::$_propertyNames as $propertyName) {
			$as = strlen($pre) > 0 && $shouldRenameField ? ' AS '.$prefix.$propertyName : '';

			$fields[$propertyName] = $pre.$propertyName.$as;
		}

		return $asArray ? $fields : implode(',', $fields);
	}
	
	/** 
	 *  Creates an entity based on the supplied array keys and values and fieldPrefix (if necessary) 
	 * 
	 *  @param array $values
	 *  @param string $fieldPrefix
	 *  @return Entity
	 * */
	public static function buildFromArray($values, $fieldPrefix = NULL) {
		$className = get_called_class();
		$entity = new $className();

		$didSetAtLeastOneProperty = FALSE;
		
		$classProperties = $className::getAllFields(NULL, FALSE, TRUE);
		
		foreach ($values as $property=>$value) {
			if (!isset($value)) {
				continue;
			}
			else if (!isset($fieldPrefix)) {
				$prop = $property;
			}
			else if (substr_compare($property, $fieldPrefix, 0, strlen($fieldPrefix), TRUE) === 0) {
				$prop = substr($property, strlen($fieldPrefix));
			}
			else {
				continue;
			}
			
			if (isset($classProperties[$prop])) {
				$setter = 'set'.$prop;

				if (method_exists($entity, $setter)) {
					$entity->$setter($value);
				}
				else if ($prop === 'ID') {
					$entity->$prop = intval($value);
				}
				else {
					$entity->$prop = $value;
				}
				
				$didSetAtLeastOneProperty = TRUE;
			}
		}
		
		return $didSetAtLeastOneProperty ? $entity : FALSE;
	}
}
