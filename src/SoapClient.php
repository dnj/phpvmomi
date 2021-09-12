<?php
namespace DNJ\PHPVMOMI;

use DNJ\PHPVMOMI\DataObjects\DynamicData;

class SoapClient extends \SoapClient{

	public function __call($function_name, $arguments)
	{
		$arguments = self::checkForDynamicData($arguments);
		return parent::__call($function_name, $arguments);
	}

	private static function checkForDynamicData($arguments)
	{
		foreach ($arguments as $key => $argument) {
			$value = $argument;
			if (is_array($value)) {
				$value = self::checkForDynamicData($value);
			} elseif (is_object($value)) {
				if ($value instanceof DynamicData) {
					$value->getSoapData();
				} else {
					self::checkForDynamicData($value);
				}
			}
			if (is_object($arguments)) {
				$arguments->$key = $value;
			} elseif(is_array($arguments)) {
				$arguments[$key] = $value;
			}
		}
		return $arguments;
	}
}