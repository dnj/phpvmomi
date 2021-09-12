<?php
namespace DNJ\PHPVMOMI\DataObjects;

/**
 *  The ConnectInfo data object type contains information about connectable virtual devices. 
 * @todo recheck
 */
class VirtualDeviceConnectInfo extends DynamicData
{
	
    /**
     * @var bool  Flag to allow the guest to control whether the connectable device is connected. 
     */
	public $allowGuestControl;
	
	/**
	 * @var bool  Flag indicating the device is currently connected. Valid only while the virtual machine is running. 
	 */
    public $connected;

    /**
     * @var bool  Flag to specify whether or not to connect the device when the virtual machine starts. 
     */
    public $startConnected;
}