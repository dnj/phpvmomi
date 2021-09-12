<?php
namespace DNJ\PHPVMOMI\DataObjects\actions;

use DNJ\PHPVMOMI\API;
use DNJ\PHPVMOMI\DataObjects\DynamicData;
use DNJ\PHPVMOMI\DataObjects\VirtualDeviceDeviceBackingInfo;

trait VirtualDeviceDeviceBackingInfoTrait
{
	public static function fromAPI(API $api, DynamicData $response): VirtualDeviceDeviceBackingInfo
	{
		$object = new self();
		foreach ($response as $key => $value) {
			$object->{$key} = $value;
		}
		return $object;
    }
}