<?php

namespace dnj\phpvmomi\DataObjects;

class VirtualEthernetCardNetworkBackingInfo extends VirtualDeviceBackingInfo
{
    /** @var \dnj\phpvmomi\ManagedObjects\Network */
    public $network;

    /** @var bool */
    public $inPassthroughMode;
}
