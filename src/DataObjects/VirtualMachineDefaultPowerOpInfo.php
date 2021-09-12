<?php
namespace DNJ\PHPVMOMI\DataObjects;

/**
 * The DefaultPowerOpInfo data object type holds the configured defaults for the power operations on a virtual machine. The properties indicated whether to do a "soft" or guest initiated operation, or a "hard" operation. 
 * @todo recheck
 * @see https://vdc-download.vmware.com/vmwb-repository/dcr-public/b50dcbbf-051d-4204-a3e7-e1b618c1e384/538cf2ec-b34f-4bae-a332-3820ef9e7773/vim.vm.DefaultPowerOpInfo.html
 */
class VirtualMachineDefaultPowerOpInfo extends DynamicData
{
	
	/**
	 * @var srting|null Default operation for power off: soft or hard
	 */
	public $defaultPowerOffType;

	/**
	 * @var srting|null Default operation for reset: soft or hard 
	 */
	public $defaultResetType;

	/** 
	 * @var srting|null Default operation for suspend: soft or hard 
	 */
	public $defaultSuspendType;

	/**
	 * @var srting|null Describes the default power off type for this virtual machine. The possible values are specified by the PowerOpType. 
	 * 				* hard - Perform power off by using the PowerOff method. 
	 * 				* soft - Perform power off by using the ShutdownGuest method. 
	 * 				* preset - The preset value is specified in the defaultPowerOffType section. 
	 * 			   This setting is advisory and clients can choose to ignore it. 
	 */
	public $powerOffType;


	/**
	 * @var srting|null Describes the default reset type for this virtual machine. The possible values are specified by the PowerOpType. 
	 * 				* hard - Perform reset by using the Reset method. 
	 * 				* soft - Perform reset by using the RebootGuest method.
	 * 				* preset - The preset value is specified in the defaultResetType section.
	 * 			   This setting is advisory and clients can choose to ignore it. 
	 */
	public $resetType;

	/**
	 * @var srting|null Behavior of virtual machine when it receives the S1 ACPI call.
	 */
	public $standbyAction;


	/**
	 * @var srting|null Describes the default suspend type for this virtual machine. The possible values are specified by the PowerOpType. 
	 * 				* hard - Perform suspend by using the Suspend method. 
	 * 				* soft - Perform suspend by using the StandbyGuest method.
	 * 				* preset - The preset value is specified in the defaultSuspendType section.
	 * 			  This setting is advisory and clients can choose to ignore it. 
	 */
	public $suspendType;
}
