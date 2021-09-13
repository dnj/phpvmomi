<?php
namespace dnj\phpvmomi\DataObjects;

class VirtualDeviceDeviceBackingInfo extends VirtualDeviceBackingInfo
{
	use actions\VirtualDeviceDeviceBackingInfoTrait;

	/** @var string $deviceName */
	public $deviceName;

	/** @var bool $useAutoDetect */
	public $useAutoDetect;
}
