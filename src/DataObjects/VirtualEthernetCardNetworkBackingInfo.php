<?php
namespace dnj\phpvmomi\DataObjects;

use dnj\phpvmomi\ManagedObjects\Network;

class VirtualEthernetCardNetworkBackingInfo extends VirtualDeviceBackingInfo
{

	/** @var \dnj\phpvmomi\ManagedObjects\Network $network */
	public $network;

	/** @var bool $inPassthroughMode */
	public $inPassthroughMode;
}
