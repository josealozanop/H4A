<?php

class dbUtils{
	
	/**
		pre: $object must expand serializableObject
	**/
	public static function mapObject($object, $map){
		$configArray = $object->toArray();
		$parsedData = array();
		foreach ($map as $key => $value) {
			if($configArray[$key] or $configArray[$key]==0){
				$parsedData[$value] = $configArray[$key];
			}
		}
		return $parsedData;
	}
}

?>