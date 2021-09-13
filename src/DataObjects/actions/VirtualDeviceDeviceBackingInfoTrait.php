<?php
namespace dnj\phpvmomi\DataObjects\actions;

use dnj\phpvmomi\API;
use dnj\phpvmomi\DataObjects\DynamicData;
use dnj\phpvmomi\DataObjects\VirtualDeviceDeviceBackingInfo;

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