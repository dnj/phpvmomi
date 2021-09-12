<?php
namespace DNJ\PHPVMOMI\ManagedObjects\actions;

use DNJ\PHPVMOMI\API;

trait NeedAPITrait {

	/**
	 * @var API $api
	 */
	protected $api;

	public function __construct(API $api)
	{
		$this->api = $api;
	}

	public function setAPI(API $api): void
	{
		$this->api = $api;
		foreach (get_class_vars(static::class) as $key => $value) {
			if (is_object($value) and method_exists($value, "setAPI") and property_exists($value, 'api') and $value->api === null) {
				$value->setAPI($api);
			}
		}
	}
}
