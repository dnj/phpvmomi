<?php
namespace DNJ\PHPVMOMI\DataObjects;

class VirtualDeviceDeviceBackingInfo extends VirtualDeviceBackingInfo
{
	use actions\VirtualDeviceDeviceBackingInfoTrait;

	/** @var string $deviceName */
	public $deviceName;

	/** @var bool $useAutoDetect */
	public $useAutoDetect;
}
