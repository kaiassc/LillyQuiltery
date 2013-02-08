<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) || strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) !== 'xmlhttprequest') {
	//header(':', true, 505);
	//die('<p style="font-size: 24px; margin: 20px 10px 20px 10px;">Please don\'t try to hurt our site... : (</p>');
}

require_once('application/core/RESTController.php');

class Api_v1_Controller extends RESTController {

	protected static $MAX_LIMIT = 50;
	
	protected static $WHERE_FIELDS = array();

	/** 
	 * Example: $GET_FIELDS
	 * 
	 *  array(
	 *	    'ALIAS_NAME' => array(
	 *		    'field'             =>  'FIELD_NAME',               (required)
	 *		    'foreignField'      =>  'FOREIGN_FIELD_NAME',       (optional - name of field on 'field' above)
	 *		    'function'          =>  'FUNCTION_NAME',   (optional - replaces 'field' functionality)
	 *		    'requiredFields'    =>  array(                      (required if using 'function' - contains list of fields needed by 'function')
	 *		    	                        'ALIAS_NAME_1',
	 *		    	                        'ALIAS_NAME_2',
	 *		    	                        etc..
	 *		                            )
	 *          'isEnabled',        =>  TRUE | FALSE                (optional - completely disables the alias - default: TRUE)
	 *          'isDefault'         =>  TRUE | FALSE                (optional - retrieved by default if fields are not specified in query - default: TRUE)
	 *	    )
	 *  )
	*/
	protected static $GET_FIELDS = array();

	protected static $PUT_FIELDS = array();

	protected static $ORDER_BY_FIELDS = array();
	
	protected static $FUNCTIONS = array(
		'GT' => array(
			'operator' => '>',
			'type' => 'number'
		),
		'GTE' => array(
			'operator' => '>=',
			'type' => 'number'
		),
		'LT' => array(
			'operator' => '<',
			'type' => 'number'
		),
		'LTE' => array(
			'operator' => '<=',
			'type' => 'number'
		),
		'LIKE' => array(
			'operator' => 'LIKE',
			'type' => 'string',
			'replace' => array(
				'~' => '%'
			)
		),
		'IN' => array(
			'operator' => 'IN',
			'type' => 'array:string'
		),
		'ALL' => array(
			'operator' => '=',
			'shouldConcatenate' => TRUE,
			'type' => 'array:string'
		)
	);
	
	protected static $MISC_FIELDS = array(
		'method' => TRUE,
		'callback' => TRUE,
		'_' => TRUE,
		'fields' => TRUE,
		'limit' => TRUE,
		'offset' => TRUE,
		'orderBy' => TRUE,
		'suppress_http_status_codes' => TRUE
	);
		
	const ErrorMessageCommunication =   'There was a communication error with Lilly Quiltery';
	const ReportErrorEmail =            'support@lillyquiltery.net';
	
	protected $suppressHTTPStatusCodes = FALSE;
	
	public function index_get($id = NULL) {
		$className = $this->className;
		$table = $className::$TABLE;
		$tableAbbrv = $className::$TABLE_ABBREVIATION;
		$result = NULL;
		$isSingleResult = FALSE;
		
		$suppressHTTPStatusCodes = trim(strtolower($this->input->get('suppress_http_status_codes')));
		$this->suppressHTTPStatusCodes = $suppressHTTPStatusCodes === 'true' || $suppressHTTPStatusCodes === '1';
		
		// check for invalid parameters
		/** @var array $getParameters */
		$getParameters = $this->input->get();
		if ($getParameters) {
			foreach($getParameters as $parameter=>$value) {
				if (!isset($className::$MISC_FIELDS[$parameter]) && !isset($className::$GET_FIELDS[$parameter])) {
					$error = new Error(Error::Syntax, "Invalid parameter used in query: '{$parameter}'");
					$this->error(400, $error->getCode(), self::ErrorMessageCommunication, $error->getDescription(TRUE));
				}
			}
		}
			
		$pdo = $this->getPDO();
		
		$fields = $this->getFields($this->input->get('fields'));
		$requiredFields = $this->getRequiredFields($fields);
		
		// merge the required fields with explicit fields for query formatting reasons (the fields that are only required will be unset from the result after it is retrieved)
		$mergedFields = array_merge($fields, $requiredFields);
		
		if (count($mergedFields) > 0) {
			$joins = $this->getJoins($mergedFields);
			$fieldsString = $className::getFieldsString($mergedFields);
			
			// if object ID is specified manually in the URL (packs/4477 VS packs?param=value)
			// only one object will be returned
			if (isset($id)) {
				$id = trim($id);
				
				if (!is_numeric($id) || intval($id) != $id) {
					$error = new Error(Error::Syntax, "Resource ID needs to be of type 'int' but was supplied with '{$id}'");
					$this->error(400, $error->getCode(), self::ErrorMessageCommunication, $error->getDescription(TRUE));
				}

				$isSingleResult = TRUE;

				$joinsString = $className::getJoinsString($joins);

				$resultsSQL = "SELECT {$fieldsString} FROM {$table} {$tableAbbrv}{$joinsString} WHERE {$tableAbbrv}.ID = :id";
				$resultsStmt = $pdo->prepare($resultsSQL);
				$resultsSuccess = $resultsStmt->execute(array(
					':id' => $id
				));

				if (!$resultsSuccess) {
					$error = new Error(Error::SQLUnknown, 'Line '.__LINE__.'. '.implode(' ', $resultsStmt->errorInfo()));
					$this->error(500, $error->getCode(), self::ErrorMessageCommunication, $error->getDescription(TRUE), self::ReportErrorEmail);
				}

				$results = $resultsStmt->fetchAll(PDO::FETCH_ASSOC);

				$resultsCount = count($results);
				if ($resultsCount > 1) {
					$error = new Error(Error::Redundancy);
					$this->error(500, $error->getCode(), self::ErrorMessageCommunication, $error->getDescription(), self::ReportErrorEmail);
				}
				else if ($resultsCount == 0) {
					$error = new Error(Error::NoResults);
					$this->error(404, $error->getCode(), $error->getDescription(), $error->getDescription());
				}

				$className::finalizeObjects($results, $fields, $requiredFields);

				$result = $results[0];
			}
			else {
				$queryParameters = array();
				
				$wheres = $this->getWheres();
				$wheresString = $this->getWheresString($wheres, $queryParameters, $joins);
				
				// limit + offset
				$offset = $this->getOffset();
				$limit = $this->getLimit();
				
				$queryParameters[':_offset'] = array(
					'value' => $offset,
					'pdoParamType' => PDO::PARAM_INT
				);

				$queryParameters[':_limit'] = array(
					'value' => $limit,
					'pdoParamType' => PDO::PARAM_INT
				);
				
				$orderBys = $this->getOrderBys();
				$orderBysString = $this->getOrderBysString($orderBys);
				$joinsString = $className::getJoinsString($joins);
				
				$resultsSQL = "SELECT {$fieldsString} FROM {$table} {$tableAbbrv}{$joinsString} {$wheresString} {$orderBysString} LIMIT :_offset, :_limit";
				$countSQL = "SELECT COUNT(0) AS cnt FROM {$table} {$tableAbbrv}{$joinsString} {$wheresString}";
				
				$resultsStmt = $pdo->prepare($resultsSQL);
				$countStmt = $pdo->prepare($countSQL);

				foreach ($queryParameters as $placeholder=>$config) {
					if ($placeholder != ':_limit' && $placeholder != ':_offset') {
						$countStmt->bindValue($placeholder, $config['value'], $config['pdoParamType']);
					}
					
					$resultsStmt->bindValue($placeholder, $config['value'], $config['pdoParamType']);
				}
				
				if (!$resultsStmt->execute()) {
					$error = new Error(Error::SQLUnknown, 'Line '.__LINE__.'. '.implode(' ', $resultsStmt->errorInfo()));
					$this->error(500, $error->getCode(), self::ErrorMessageCommunication, $error->getDescription(TRUE));
				}
								
				$objects = $resultsStmt->fetchAll(PDO::FETCH_ASSOC);
				
				if (!$countStmt->execute()) {
					$error = new Error(Error::SQLUnknown, 'Line '.__LINE__.'. '.implode(' ', $countStmt->errorInfo()));
					$this->error(500, $error->getCode(), self::ErrorMessageCommunication, $error->getDescription(TRUE));
				}
				
				$countResult = $countStmt->fetchAll(PDO::FETCH_ASSOC);
				$count = intval($countResult[0]['cnt']);

				$className::finalizeObjects($this, $objects, $fields, $requiredFields);

				$result = $objects;
			}

			// response
			$response['meta']['status'] = 200;
			
			if (!isset($result)) {
				$error = new Error(Error::Unknown, 'No results seem to have been generated');
				$this->error(500, $error->getCode(), self::ErrorMessageCommunication, $error->getDescription(TRUE), self::ReportErrorEmail);
			}

			$response['response'] = $result;

			if (!$isSingleResult) {
				if (!isset($limit) || !isset($offset) || !isset($count)) {
					$error = new Error(Error::APIConfig, 'Line '.__LINE__);
					$this->error(500, $error->getCode(), self::ErrorMessageCommunication, $error->getDescription(TRUE), self::ReportErrorEmail);
				}

				$response['meta']['limit'] = $limit;
				$response['meta']['offset'] = $offset;
				$response['meta']['count'] = $count;
			}
			
			var_dump($response['response'][0]);
			die();
			
			$formattedResponse = $this->input->get('callback') ? $this->input->get('callback').'('.json_encode($response).')' : json_encode($response);
			
			$this->response($formattedResponse, 200);
		}
	}
	
	protected static function finalizeObjects($controller, &$objects, $fields, $requiredFields) {
		$className = get_called_class();
		
		// insert any data after object is retrieved
		foreach ($fields as $alias=>$config) {
			if (isset($config['function'])) {
				$function = $config['function'];

				foreach ($objects as $i=>$object) {
					$value = $className::$function($controller, $object);

					$objects[$i][$alias] = $value;
				}
			}
			else if (isset($config['entity'])) {
				/*
				$extraEntity = $config['entity'];
				$extraEntityAbbreviation = '_abbr2_';
				$extraField = $config['field'];
				$extraForeignField = $config['foreignField'];
				$extraForeignAbbreviation = '_abbr3_';

				foreach ($objects as $i=>$object) {
					$objectID = $object['id'];

					$extraObjects = $em->createQuery("SELECT {$extraEntityAbbreviation}.{$extraField} FROM {$extraEntity} {$extraEntityAbbreviation} JOIN {$extraEntityAbbreviation}.{$extraForeignField} {$extraForeignAbbreviation} WHERE {$extraForeignAbbreviation}.ID = {$objectID}")->getResult();
					
					$deObjectifiedExtraObjects = array();
					foreach ($extraObjects as $extraObject) {
						$deObjectifiedExtraObjects[] = $extraObject[$extraField];
					}

					$objects[$i][$whereAlias] = $deObjectifiedExtraObjects;
				}
				*/
			}

			if (isset($config['foreignAPI'])) {
				$foreignObjects = array();
				$foreignAPIClassName = "Api_v1_{$config['foreignAPI']}_Controller";

				if (!class_exists($foreignAPIClassName, FALSE)) {
					require_once(dirname(__FILE__)."/{$foreignAPIClassName}.php");
				}

				$foreignAPIFields = isset($config['partialFields']) ? $config['partialFields'] : $foreignAPIClassName::$GET_FIELDS;
				$foreignAbbrv = $foreignAPIClassName::$TABLE_ABBREVIATION;
				
				foreach ($objects as $i=>$object) {
					if (!isset($foreignObjects[$i])) {
						$foreignObjects[$i] = array();
					}
					
					if ($config['foreignAPI'] == 'Users') {
						var_dump($foreignAPIFields);
					}
					
					foreach ($foreignAPIFields as $foreignAlias=>$foreignConfig) {
						$prefixedAlias = "{$foreignAbbrv}_{$foreignAlias}";
						$foreignObjects[$i][$foreignAlias] = $object[$prefixedAlias];
						unset($objects[$i][$prefixedAlias]);
					}
				}
				
				// TODO: required fields for foreign finalizing?!
				$foreignAPIClassName::finalizeObjects($controller, $foreignObjects, $foreignAPIFields, array());

				foreach ($foreignObjects as $i=>$foreignObject) {
					foreach ($foreignObject as $foreignAlias=>$value) {
						$objects[$i][$alias][$foreignAlias] = $value;
					}
				}
			}
			else if (isset($config['type'])) {
				$type = $config['type'];
				
				if ($type == 'int') {
					foreach ($objects as $i=>$object) {
						$objects[$i][$alias] = intval($objects[$i][$alias]);
					}
				}
				else if ($type == 'number') {
					foreach ($objects as $i=>$object) {
						$objects[$i][$alias] = floatval($objects[$i][$alias]);
					}
				}
			}
		}

		foreach ($requiredFields as $alias=>$config) {
			foreach ($objects as $key=>$object) {
				unset($objects[$key][$alias]);
			}
		}
	}

	protected function getFields($specifiedFields = NULL) {
		$verifiedFields = array();
		$className = $this->className;
		
		if (isset($specifiedFields) && $specifiedFields !== FALSE) {
			$specifiedFieldsArray = explode(',', $specifiedFields);
			foreach ($specifiedFieldsArray as $specifiedAlias) {
				$specifiedAlias = trim($specifiedAlias);
				// if alias exists and is enabled
				if (isset($className::$GET_FIELDS[$specifiedAlias]) && (!isset($className::$GET_FIELDS[$specifiedAlias]['isEnabled']) || $className::$GET_FIELDS[$specifiedAlias]['isEnabled'] === TRUE) ) {
					$verifiedFields[$specifiedAlias] = $className::$GET_FIELDS[$specifiedAlias];
				}
				else {
					// try partial object syntax
					$firstParenPos = strpos($specifiedAlias, '(');
					$lastParenPos = strpos($specifiedAlias, ')');
					
					if ($firstParenPos === FALSE || $lastParenPos === FALSE) {
						$error = new Error(Error::APIInvalidField, "Invalid field name specified in 'fields' parameter: '{$specifiedAlias}'");
						$this->error(400, $error->getCode(), self::ErrorMessageCommunication, $error->getDescription(TRUE));
					}
					
					if ($lastParenPos != strlen($specifiedAlias) - 1) {
						$error = new Error(Error::APIInvalidValue, "Invalid partial object syntax: '{$specifiedAlias}'");
						$this->error(400, $error->getCode(), self::ErrorMessageCommunication, $error->getDescription(TRUE));
					}
					
					$partialObjAlias = substr($specifiedAlias, 0, $firstParenPos);

					if ( isset($className::$GET_FIELDS[$partialObjAlias]) && (!isset($className::$GET_FIELDS[$partialObjAlias]['isEnabled']) || $className::$GET_FIELDS[$partialObjAlias]['isEnabled'] === TRUE) ) {
						$partialObjFieldsString = trim(substr($specifiedAlias, $firstParenPos + 1, -1));
						
						if (strlen($partialObjFieldsString) == 0) {
							$error = new Error(Error::APIInvalidValue, "Invalid partial object syntax (no fields specified): '{$specifiedAlias}'");
							$this->error(400, $error->getCode(), self::ErrorMessageCommunication, $error->getDescription(TRUE));
						}
						
						$partialObjFields = explode(':', $partialObjFieldsString);
						
						$foreignAPIClassName = "Api_v1_{$className::$GET_FIELDS[$partialObjAlias]['foreignAPI']}_Controller";
						if (!class_exists($foreignAPIClassName, FALSE)) {
							require_once(dirname(__FILE__)."/{$foreignAPIClassName}.php");
						}
						
						$partialFieldsWithConfigs = array();
						
						foreach ($partialObjFields as $i=>$partialObjField) {
							$partialObjField = trim($partialObjField);
							
							if (!isset($foreignAPIClassName::$GET_FIELDS[$partialObjField])) {
								$error = new Error(Error::APIInvalidField, "Invalid subfield '{$partialObjField}' specified in partial object : '{$partialObjAlias}'");
								$this->error(400, $error->getCode(), self::ErrorMessageCommunication, $error->getDescription(TRUE));
							}
							
							$partialFieldsWithConfigs[$partialObjField] = $foreignAPIClassName::$GET_FIELDS[$partialObjField];
						}

						$verifiedFields[$partialObjAlias] = $className::$GET_FIELDS[$partialObjAlias];
						$verifiedFields[$partialObjAlias]['partialFields'] = $partialFieldsWithConfigs; // ------ gets should be full, check with dumpage
					}
				}
			}
		}
		else {
			// use all fields specified in the API class that are enabled and default
			foreach ($className::$GET_FIELDS as $defaultAlias => $defaultConfig) {
				// if alias is enabled and default enabled
				if ( (!isset($config['isEnabled']) || $config['isEnabled'] === TRUE) && (!isset($config['isDefault']) || $config['isDefault'] === TRUE) ) {
					$verifiedFields[$defaultAlias] = $defaultConfig;
				}
			}
		}
		
		return $verifiedFields;
	}
	
	protected function getRequiredFields($fields) {
		$requiredFields = array();
		$className = $this->className;

		// find any fields necessary for calculation of another field in the get fields defined above that are not already defined themselves above
		foreach ($fields as $config) {
			if (isset($config['requiredFields'])) {
				foreach ($config['requiredFields'] as $requiredAlias) {
					if (!isset($fields[$requiredAlias]) && !isset($requiredFields[$requiredAlias])) {
						$requiredFields[$requiredAlias] = $className::$GET_FIELDS[$requiredAlias];
					}
				}
			}
		}

		// check any nested required fields of the already required fields
		$hasCheckedAllRequirements = FALSE;
		while (!$hasCheckedAllRequirements) {
			$hasCheckedAllRequirements = TRUE;

			foreach ($requiredFields as $config) {
				if (isset($config['requiredFields'])) {
					foreach ($config['requiredFields'] as $requiredAlias) {
						if (!isset($fields[$requiredAlias]) && !isset($requiredFields[$requiredAlias])) {
							$requiredFields[$requiredAlias] = $className::$GET_FIELDS[$requiredAlias];
							$hasCheckedAllRequirements = FALSE;
						}
					}
				}
			}
		}
		
		return $requiredFields;
	}
	
	protected static function getJoins($fields) {
		$joins = array();
		
		foreach ($fields as $alias=>$config) {
			if (isset($config['field']) && !isset($config['entity'])) {
				$databaseField = $config['field'];

				if (isset($config['foreignAPI'])) {
					$foreignAPIClassName = "Api_v1_{$config['foreignAPI']}_Controller";
					
					if (!class_exists($foreignAPIClassName, FALSE)) {
						require_once(dirname(__FILE__)."/{$foreignAPIClassName}.php");
					}

					$foreignTable = $foreignAPIClassName::$TABLE;
					$foreignTableAbbrv = $foreignAPIClassName::$TABLE_ABBREVIATION;
					$foreignObjectFields = isset($config['partialFields']) ? $config['partialFields'] : $foreignAPIClassName::$GET_FIELDS;

					$joins[$databaseField] = $config;
					$joins[$databaseField]['table'] = $foreignTable;
					$joins[$databaseField]['tableAbbreviation'] = $foreignTableAbbrv;
					$joins[$databaseField]['joinDirection'] = isset($config['joinDirection']) ? strtoupper($config['joinDirection']) : 'INNER';
					$joins[$databaseField]['foreignJoins'] = $foreignAPIClassName::getJoins($foreignObjectFields);
				}
			}
		}
		
		return $joins;
	}

	/**
	 * @param $hasPlural
	 * @return array
	 */
	protected function getWheres(&$hasPlural = NULL) {
		$className = $this->className;
		$hasPlural = FALSE;
		$wheres = array();

		foreach ($className::$WHERE_FIELDS as $alias=>$config) {
			$param = $this->input->get($alias);

			if ($param) {
				$wheres[$alias] = $config;
				$wheres[$alias]['value'] = $param;

				if (isset($config['isPlural']) && $config['isPlural'] === TRUE) {
					$hasPlural = TRUE;
				}
			}
		}
		
		return $wheres;
	}
	
	protected function getOrderBys() {
		$className = $this->className;
		$tableAbbrv = $className::$TABLE_ABBREVIATION;
		$orderBy = $this->input->get('orderBy');
		$orderBys = array();
		
		if ($orderBy) {
			$orderByList = explode(',', $orderBy);

			foreach ($orderByList as $orderByValue) {
				$alias = $orderByValue;
				$direction = 'ASC';

				if (strpos($orderByValue, ':') !== FALSE) {
					$ordParts = explode(':', $orderByValue);
					
					if (count($ordParts) == 2) {
						$alias = $ordParts[0];

						$upperDirection = strtoupper($ordParts[1]);
						
						if ($upperDirection != 'ASC' && $upperDirection != 'DESC') {
							$error = new Error(Error::APIInvalidValue, "The direction specifier for orderBy fields must be either 'ASC' or 'DESC'");
							$this->error(400, $error->getCode(), self::ErrorMessageCommunication, $error->getDescription(TRUE));
						}

						$direction = $upperDirection;
					}
					else {
						$error = new Error(Error::APIInvalidValue, "The direction specifier for orderBy fields must be either 'ASC' or 'DESC'");
						$this->error(400, $error->getCode(), self::ErrorMessageCommunication, $error->getDescription(TRUE));
					}
				}

				if (isset($className::$ORDER_BY_FIELDS[$alias])) {
					$orderByField = $className::$ORDER_BY_FIELDS[$alias]['field'];

					if (isset($className::$ORDER_BY_FIELDS[$alias]['foreignField'])) {
						// join any tables that are required by "orderBY" that are not already joined
						if (!isset($joins[$orderByField])) {
							$joins[$orderByField]['entityAbbreviation'] = "tbl_{$orderByField}";
							if (isset($orderByFields[$alias]['isPlural'])) {
								$joins[$orderByField]['isPlural'] = $orderByFields[$alias]['isPlural'];
							}
						}

						$orderBys[$alias]['direction'] = $direction;
						$orderBys[$alias]['field'] = $className::$ORDER_BY_FIELDS[$alias]['foreignField'];
						$orderBys[$alias]['tableAbbreviation'] = "tbl_{$orderByField}";
					}
					else {
						$orderBys[$alias]['direction'] = $direction;
						$orderBys[$alias]['field'] = $className::$ORDER_BY_FIELDS[$alias]['field'];
						$orderBys[$alias]['tableAbbreviation'] = $tableAbbrv;
					}
				}
			}
		}
		
		return $orderBys;
	}

	protected function getOffset() {
		$offset = $this->input->get('offset');
		
		if ($offset) {
			if (!is_numeric($offset) || intval($offset) != $offset) {
				$error = new Error(Error::APIInvalidType, "Expecting value for 'offset' to be of type 'int' but received '{$offset}'");
				$this->error(400, $error->getCode(), self::ErrorMessageCommunication, $error->getDescription(TRUE));
			}
			else if ($offset < 0) {
				$error = new Error(Error::APIInvalidValue, "The offset for this resource must be positive");
				$this->error(400, $error->getCode(), self::ErrorMessageCommunication, $error->getDescription(TRUE));
			}
		}
		else {
			$offset = 0;
		}
		
		return intval($offset);
	}
	
	protected function getLimit() {
		$className = $this->className;
		$limit = $this->input->get('limit');
		
		if ($limit) {
			if (!is_numeric($limit) || intval($limit) != $limit) {
				$error = new Error(Error::APIInvalidType, "Expecting value for 'limit' to be of type 'int' but received '{$limit}'");
				$this->error(400, $error->getCode(), self::ErrorMessageCommunication, $error->getDescription(TRUE));
			}
			else if ($limit > $className::$MAX_LIMIT || $limit < 0) {
				$error = new Error(Error::APIInvalidValue, "The limit for this resource must be positive and less than the maximum of {$className::$MAX_LIMIT}");
				$this->error(400, $error->getCode(), self::ErrorMessageCommunication, $error->getDescription(TRUE));
			}
		}
		else {
			$limit = 10;
		}
		
		return intval($limit);
	}
	
	protected static function getFieldsString($fields, $shouldPrefix = FALSE) {
		// accumulate fields into one string
		$className = get_called_class();
		$tableAbbrv = $className::$TABLE_ABBREVIATION;

		$fieldsString = '';
		$i = 0;
		
		foreach ($fields as $alias=>$config) {
			if (isset($config['field']) && !isset($config['entity'])) {
				$field = $config['field'];

				if ($i > 0) {
					$fieldsString .= ', ';
				}

				if (isset($config['foreignAPI'])) {
					$foreignAPIClassName = "Api_v1_{$config['foreignAPI']}_Controller";
					if (!class_exists($foreignAPIClassName, FALSE)) {
						require_once(dirname(__FILE__)."/{$foreignAPIClassName}.php");
					}
					
					$foreignObjectFields = isset($config['partialFields']) ? $config['partialFields'] : $foreignAPIClassName::$GET_FIELDS;

					$fieldsString .= $foreignAPIClassName::getFieldsString($foreignObjectFields, TRUE);
				}
				else {
					$fieldsString .= "{$tableAbbrv}.{$field}";
					
					if ($alias != $field || $shouldPrefix) {
						$prefixedAlias = $shouldPrefix ? "{$tableAbbrv}_{$alias}" : $alias;
						$fieldsString .= " AS {$prefixedAlias}";
					}
				}

				$i++;
			}
		}
				
		return $fieldsString;
	}
	
	protected static function getJoinsString($joins) {
		$className = get_called_class();
		$tableAbbrv = $className::$TABLE_ABBREVIATION;
		
		$joinsString = '';
		
		foreach ($joins as $databaseField=>$config) {
			$joinsString .= " {$config['joinDirection']} JOIN {$config['table']} {$config['tableAbbreviation']} ON {$tableAbbrv}.{$databaseField} = {$config['tableAbbreviation']}.ID";
			
			$foreignAPIClassName = "Api_v1_{$config['foreignAPI']}_Controller";

			if (!class_exists($foreignAPIClassName, FALSE)) {
				require_once(dirname(__FILE__)."/{$foreignAPIClassName}.php");
			}
			
			$joinsString .= $foreignAPIClassName::getJoinsString($config['foreignJoins']);
		}
		
		return $joinsString;
	}
	
	protected function getWheresString($wheres, &$queryParameters, &$joins) {
		$whereString = '';
		$queryINCount = 0;
		$className = $this->className;
		$tableAbbrv = $className::$TABLE_ABBREVIATION;

		if (count($wheres) > 0) {
			$whereString = 'WHERE ';
			$whereIndex = 0;
			
			foreach ($wheres as $whereAlias=>$whereConfig) {
				$queryOperator = "=";
				$queryPlaceholder = NULL;
				$shouldConcatenate = FALSE;
				$usesFunction = FALSE;
				$parameterType = PDO::PARAM_STR;

				// filter value through functions
				foreach ($className::$FUNCTIONS as $functionName=>$functionConfig) {
					if (substr_compare("{$functionName}(", $whereConfig['value'], 0, strlen($functionName) + 1, TRUE) === 0 && substr($whereConfig['value'], -1) === ')') {
						$usesFunction = TRUE;
						
						$functionValue = trim(substr($whereConfig['value'], strlen($functionName) + 1, -1));

						if (strlen($functionValue) == 0) {
							$error = new Error(Error::APIInvalidValue, "Empty value specified in function '{$functionName}'");
							$this->error(400, $error->getCode(), self::ErrorMessageCommunication, $error->getDescription(TRUE));
						}

						if (isset($functionConfig['replace'])) {
							foreach ($functionConfig['replace'] as $old => $new) {
								$functionValue = str_replace($old, $new, $functionValue);
							}
						}

						$queryOperator = $functionConfig['operator'];
						$valuesToConcatenate = NULL;

						// enforce variable type
						if (isset($functionConfig['type'])) {
							if ($functionConfig['type'] === 'int') {
								$parameterType = PDO::PARAM_INT;

								if (!is_numeric($functionValue) || intval($functionValue) != $functionValue) {
									$error = new Error(Error::APIInvalidType, "Expecting value for function '{$functionName}' to be of type '{$functionConfig['type']}' but received '{$functionValue}'");
									$this->error(400, $error->getCode(), self::ErrorMessageCommunication, $error->getDescription(TRUE));
								}
							}
							else if ($functionConfig['type'] === 'number') {
								$parameterType = PDO::PARAM_STR;

								if (!is_numeric($functionValue)) {
									$error = new Error(Error::APIInvalidType, "Expecting value for function '{$functionName}' to be of type '{$functionConfig['type']}' but received '{$functionValue}'");
									$this->error(400, $error->getCode(), self::ErrorMessageCommunication, $error->getDescription(TRUE));
								}
							}
							else if (substr($functionConfig['type'], 0, 5) === 'array') {
								$functionArrayValues = explode(',', $functionValue);

								$shouldConcatenate = isset($functionConfig['shouldConcatenate']) && $functionConfig['shouldConcatenate'] === TRUE;

								if ($shouldConcatenate) {
									$valuesToConcatenate = $functionArrayValues;
								}

								foreach ($functionArrayValues as $index=>$value) {
									$functionArrayValues[$index] = trim($value);
									if (strlen($functionArrayValues[$index]) == 0) {
										$error = new Error(Error::APIInvalidValue, "Empty value in list for field '{$whereAlias}'");
										$this->error(400, $error->getCode(), self::ErrorMessageCommunication, $error->getDescription(TRUE));
									}
								}

								if (strlen($functionConfig['type']) > 5) {
									$parameterType = PDO::PARAM_STR;

									if (substr($functionConfig['type'], 5, 1) == ':') {
										$arrayType = substr($functionConfig['type'], 6);

										if ($arrayType === 'int') {
											$parameterType = PDO::PARAM_INT;

											foreach ($functionArrayValues as $value) {
												if (!is_numeric($value) || intval($value) != $value) {
													$error = new Error(Error::APIInvalidType, "Expecting list values for function '{$functionName}' to be of type '{$arrayType}' but received '{$functionValue}'");
													$this->error(400, $error->getCode(), self::ErrorMessageCommunication, $error->getDescription(TRUE));
												}
											}
										}
										else if ($arrayType === 'number') {
											$parameterType = PDO::PARAM_STR;

											foreach ($functionArrayValues as $value) {
												if (!is_numeric($value)) {
													$error = new Error(Error::APIInvalidType, "Expecting list values for function '{$functionName}' to be of type '{$arrayType}' but received '{$functionValue}'");
													$this->error(400, $error->getCode(), self::ErrorMessageCommunication, $error->getDescription(TRUE));
												}
											}
										}
										else if ($arrayType === 'string') {
											// Okay, just fine and dandy. Nothing we can really check here is there?! ;)
											$parameterType = PDO::PARAM_STR;
										}
										else {
											$error = new Error(Error::APIConfig, 'Line '.__LINE__);
											$this->error(500, $error->getCode(), self::ErrorMessageCommunication, $error->getDescription(TRUE), self::ReportErrorEmail);
										}
									}
									else {
										$error = new Error(Error::APIConfig, 'Line '.__LINE__);
										$this->error(500, $error->getCode(), self::ErrorMessageCommunication, $error->getDescription(TRUE), self::ReportErrorEmail);
									}

									if (!$shouldConcatenate) {
										$queryINParameterNames = array();

										foreach ($functionArrayValues as $index=>$value) {
											$queryParam = ":in{$queryINCount}_{$index}";
											$queryINParameterNames[] = $queryParam;

											$queryParameters[$queryParam] = array(
												'value' => $value,
												'pdoParamType' => $parameterType
											);
										}

										$queryPlaceholder = '('.implode(",", $queryINParameterNames).')';

										$queryINCount++;
									}
								}
							}
							else if ($functionConfig['type'] === 'string') {
								// good to go
							}
							else {
								$error = new Error(Error::APIConfig, 'Line '.__LINE__);
								$this->error(500, $error->getCode(), self::ErrorMessageCommunication, $error->getDescription(TRUE), self::ReportErrorEmail);
							}
						}
						else {
							$error = new Error(Error::APIConfig, 'Line '.__LINE__);
							$this->error(500, $error->getCode(), self::ErrorMessageCommunication, $error->getDescription(TRUE), self::ReportErrorEmail);
						}

						if (!isset($queryPlaceholder)) {
							$queryPlaceholder = ":{$whereAlias}";
							$queryParameters[$queryPlaceholder] =array(
								'value' => $functionValue,
								'pdoParamType' => $parameterType
							);
						}

						break;
					}
				}
				
				if (!$usesFunction && isset($className::$GET_FIELDS[$whereAlias]['type'])) {
					$type = $className::$GET_FIELDS[$whereAlias]['type'];
					$value = $whereConfig['value'];
					
					if ($type === 'int') {
						if (!is_numeric($value) || intval($value) != $value) {
							$error = new Error(Error::APIInvalidType, "Expecting field '{$whereAlias}' to be of type '{$type}' but received '{$value}'");
							$this->error(400, $error->getCode(), self::ErrorMessageCommunication, $error->getDescription(TRUE));
						}
					}
					else if ($type === 'number') {
						if (!is_numeric($value)) {
							$error = new Error(Error::APIInvalidType, "Expecting field '{$whereAlias}' to be of type '{$type}' but received '{$value}'");
							$this->error(400, $error->getCode(), self::ErrorMessageCommunication, $error->getDescription(TRUE));
						}
					}
				}

				if (!isset($queryPlaceholder)) {
					$queryPlaceholder = ":{$whereAlias}";
					$queryParameters[$queryPlaceholder] = array(
						'value' => $whereConfig['value'],
						'pdoParamType' => $parameterType
					);
				}

				if (isset($whereConfig['foreignField'])) {
					$whereField = $whereConfig['field'];

					if (!isset($joins[$whereField])) {
						$joins[$whereField]['entityAbbreviation'] = "tbl_{$whereField}";
					}

					$queryFieldAbbreviation = $joins[$whereField]['entityAbbreviation'];
					$queryField = $whereConfig['foreignField'];
				}
				else {
					$queryFieldAbbreviation = $tableAbbrv;
					$queryField = $whereConfig['field'];
				}

				if ($whereIndex > 0) {
					$whereString .= ' AND ';
				}

				if ($shouldConcatenate) {
					/*
					if (isset($valuesToConcatenate)) {
						$i = -1;
						foreach ($valuesToConcatenate as $i=>$value) {
							if ($i == 0) {
								$whereString .= '(';
							}
							else {
								$whereString .= ' OR ';
							}
							
							$whereString .= "{$queryFieldAbbreviation}.{$queryField} {$queryOperator} '{$value}'";
						}
						
						if ($i > -1) {
							$whereString .= ')';
						}
					}
					*/
				}
				else {
					$whereString .= "{$queryFieldAbbreviation}.{$queryField} {$queryOperator} {$queryPlaceholder}";
				}

				$whereIndex++;
			}
		}
		
		return $whereString;
	}
	
	protected function getOrderBysString($orderBys) {
		$i = 0;
		$orderByString = '';
		
		foreach ($orderBys as $config) {
			if ($i == 0) {
				$orderByString = 'ORDER BY ';
			}
			else {
				$orderByString .= ', ';
			}

			$orderByString .= "{$config['tableAbbreviation']}.{$config['field']} {$config['direction']}";

			$i++;
		}
		
		return $orderByString;
	}
	
	
	
	
	
	
	public function index_post() {
		$this->response(json_encode(array('post')), $this->suppressHTTPStatusCodes ? 200 : 201);
	}
	
	
	

	
	
	public function index_put($id = NULL) {
		$className = $this->className;
		$table = $className::$TABLE;
		$tableAbbrv = $className::$TABLE_ABBREVIATION;
		$result = NULL;

		$suppressHTTPStatusCodes = trim(strtolower($this->input->get_post('suppress_http_status_codes')));
		$this->suppressHTTPStatusCodes = $suppressHTTPStatusCodes === 'true' || $suppressHTTPStatusCodes === '1';
		
		// check for invalid parameters
		/** @var array $getParameters */
		$parameters = $this->input->post() ? $this->input->post() : $this->input->get();
		if ($parameters) {
			foreach($parameters as $parameter=>$value) {
				if (!isset($className::$MISC_FIELDS[$parameter]) && !isset($className::$GET_FIELDS[$parameter])) {
					$error = new Error(Error::Syntax, "Invalid parameter used in query: '{$parameter}'");
					$this->error(400, $error->getCode(), self::ErrorMessageCommunication, $error->getDescription(TRUE));
				}
			}
		}

		$pdo = $this->getPDO();
		
		$definedFields = $this->input->get_post('fields') ? $this->input->get_post('fields') : array();
		$fields = $this->getFields($definedFields);
		$requiredFields = $this->getRequiredFields($fields);
		
		var_dump($fields);
		die();

		// merge the required fields with explicit fields for query formatting reasons (the fields that are only required will be unset from the result after it is retrieved)
		$mergedFields = array_merge($fields, $requiredFields);

		if (isset($id)) {
			$id = trim($id);
			
			if (!is_numeric($id) || intval($id) != $id) {
				$error = new Error(Error::Syntax, "Invalid parameter used in query: '{$parameter}'");
				$this->error(400, $error->getCode(), self::ErrorMessageCommunication, $error->getDescription(TRUE));
			}
		}
		
		if ($id !== NULL && is_numeric($id)) {
			$idAsInteger = intval($id);
			
			if ($idAsInteger > 0) {
				$em = $this->getDoctrine()->entityManager;
				$result = NULL;
				$updates = array();

				foreach ($className::$putFields as $alias=>$config) {
					$param = $this->input->get_post($alias);

					if ($param !== FALSE) {
						$updates[$config['field']] = $param;
					}
				}
				
				if (count($updates) > 0) {
					$updateString = '';
					$i = 0;
					foreach ($updates as $field=>$val) {
						
						if (substr($val, 0, 4) === 'inc~') {
							$incAmount = substr($val, 4);
							
							if (strlen($incAmount) > 0 && is_numeric($incAmount)) {
								$inc = intval($incAmount);
							}
							else {
								// TODO :error
								return;
							}
							
							
							
							$value = "{$tableAbbrv}.{$field}+{$inc}";
						}
						else {
							$value = "'{$val}'";
						}
						
						if ($i > 0) {
							$updateString .= ', ';
						}
						$updateString .= "{$tableAbbrv}.{$field}={$value}";

						$i++;
					}

					$dql = "UPDATE {$table} {$tableAbbrv} SET {$updateString} WHERE {$tableAbbrv}.ID = {$idAsInteger}";
					$query = $em->createQuery($dql);
					echo "$dql<br/><br/>";
					$result = $query->execute();
				}
				else {
					echo 'nothin to do';
				}

				if ($result !== NULL) {
					$this->response(json_encode($result), $this->suppressHTTPStatusCodes ? 200 : 200);
				}
			}
			else {
				echo 'hey now';
			}
		}
		else {
			echo 'nope';
		}
	}
	
	
	

	
	
	
	
	public function index_delete() {
		$this->response(json_encode(array('delete')), $this->suppressHTTPStatusCodes ? 200 : 200);
	}


	
	
	
	
	
	
	
	
	/**
	 * @param int $httpStatusCode
	 * @param int $errorCode
	 * @param string $userMessage
	 * @param string $developerMessage
	 * @param string $helpURL
	 */
	protected function error($httpStatusCode, $errorCode, $userMessage, $developerMessage, $helpURL = NULL) {
		$array = array(
			'status' => intval($httpStatusCode),
			'errorCode' => intval($errorCode),
			'userMessage' => $userMessage,
			'developerMessage' => $developerMessage
		);
		
		if (isset($helpURL)) {
			$array['helpURL'] = $helpURL;
		}
		
		$this->response(json_encode($array), $this->suppressHTTPStatusCodes ? 200 : $httpStatusCode);
		die();
	}
}