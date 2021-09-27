<?php

namespace dnj\phpvmomi\DataObjects;

class VirtualDeviceDeviceBackingInfo extends VirtualDeviceBackingInfo
{
    use actions\VirtualDeviceDeviceBackingInfoTrait;

    /** @var string */
    public $deviceName;

    /** @var bool */
    public $useAutoDetect;
}
