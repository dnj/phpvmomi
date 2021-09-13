<?php
namespace dnj\phpvmomi\DataObjects;

/**
 * Preferences for the legacy console application that affect the way it behaves during power operations on the virtual machine. 
 * @todo recheck
 */
class VirtualMachineConsolePreferences extends DynamicData {
	
	/**
	 * @var bool|null Power on the virtual machine when it is opened in the console.
	 */
	public $powerOnWhenOpened;

	/**
	 * @var bool|null  Enter full screen mode when this virtual machine is powered on.
	 */
	public $enterFullScreenOnPowerOn;

	/**
	 * @var bool|null Close the console application when the virtual machine is powered off or suspended.
	 */
	public $closeOnPowerOffOrSuspend;
}
