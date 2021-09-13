<?php
namespace dnj\phpvmomi\DataObjects;

/**
 * @todo recheck and complete
 * @see https://vdc-download.vmware.com/vmwb-repository/dcr-public/b50dcbbf-051d-4204-a3e7-e1b618c1e384/538cf2ec-b34f-4bae-a332-3820ef9e7773/vim.vm.ConfigSpec.html
 */
class VirtualMachineConfigSpec extends DynamicData
{
	/** @var string $changeVersion */
	public $changeVersion;

	/** @var string $name */
	public $name;

	/** @var string $version */
	public $version;

	/** @var string $uuid */
	public $uuid;
	
	/** @var string $instanceUuid */
	public $instanceUuid;
	
	/** @var array $npivNodeWorldWideName */
	public $npivNodeWorldWideName;

	/** @var array $npivPortWorldWideName */
	public $npivPortWorldWideName;

	/** @var string $npivWorldWideNameType */
	public $npivWorldWideNameType;

	/** @var int $npivDesiredNodeWwns */
	public $npivDesiredNodeWwns;

	/** @var int $npivDesiredPortWwns */
	public $npivDesiredPortWwns;

	/** @var bool $npivTemporaryDisabled */
	public $npivTemporaryDisabled;

	/** @var bool $npivOnNonRdmDisks */
	public $npivOnNonRdmDisks;
	
	/** @var string $npivWorldWideNameOp */
	public $npivWorldWideNameOp;

	/** @var string $locationId */
	public $locationId;

	/** @var string $guestId */
	public $guestId;
	
	/** @var string $alternateGuestName */
	public $alternateGuestName;

	/** @var string $annotation */
	public $annotation;

	/** @var VirtualMachineFileInfo $files */
	public $files;
	
	/** @var ToolsConfigInfo $tools */
	public $tools;
	
	/** @var VirtualMachineFlagInfo $flags */
	public $flags;
	
	/** @var VirtualMachineConsolePreferences $consolePreferences */
	public $consolePreferences;
	
	/** @var VirtualMachineDefaultPowerOpInfo $powerOpInfo */
	public $powerOpInfo;
	
	/** @var int $numCPUs */
	public $numCPUs;
	
	/** @var int $numCoresPerSocket */
	public $numCoresPerSocket;
	
	/** @var int $memoryMB */
	public $memoryMB;
	
	/** @var bool $memoryHotAddEnabled */
	public $memoryHotAddEnabled;
	
	/** @var bool $cpuHotAddEnabled */
	public $cpuHotAddEnabled;
	
	/** @var bool $cpuHotRemoveEnabled */
	public $cpuHotRemoveEnabled;
	
	/** @var bool $virtualICH7MPresent */
	public $virtualICH7MPresent;
	
	/** @var bool $virtualSMCPresent */
	public $virtualSMCPresent;
	
	/** @var VirtualDeviceConfigSpec[] $deviceChange */
	public $deviceChange;

	/** @var ResourceAllocationInfo $cpuAllocation */
	public $cpuAllocation;

	/** @var ResourceAllocationInfo $memoryAllocation */
	public $memoryAllocation;

	/** @var LatencySensitivity $latencySensitivity */
	public $latencySensitivity;

	/** @var VirtualMachineAffinityInfo $cpuAffinity */
	public $cpuAffinity;

	/** @var VirtualMachineAffinityInfo $memoryAffinity */
	public $memoryAffinity;

	/** @var VirtualMachineNetworkShaperInfo $networkShaper */
	public $networkShaper;

	/** @var VirtualMachineCpuIdInfoSpec[] $cpuFeatureMask */
	public $cpuFeatureMask;

	/** @var OptionValue[] $extraConfig */
	public $extraConfig;
	
	/** @var string $swapPlacement */
	public $swapPlacement;
	
	/** @var VirtualMachineBootOptions $bootOptions */
	public $bootOptions;

	/** @var VmConfigSpec $vAppConfig */
	public $vAppConfig;

	/** @var FaultToleranceConfigInfo $ftInfo */
	public $ftInfo;

	/** @var bool $vAppConfigRemoved */
	public $vAppConfigRemoved;

	/** @var bool $vAssertsEnabled */
	public $vAssertsEnabled;

	/** @var bool $changeTrackingEnabled */
	public $changeTrackingEnabled;

	/** @var string $firmware */
	public $firmware;

	/** @var int $maxMksConnections */
	public $maxMksConnections;

	/** @var bool $guestAutoLockEnabled */
	public $guestAutoLockEnabled;

	/** @var ManagedByInfo $managedBy */
	public $managedBy;

	/** @var bool $memoryReservationLockedToMax */
	public $memoryReservationLockedToMax;

	/** @var bool $nestedHVEnabled */
	public $nestedHVEnabled;

	/** @var bool $vpmcEnabled */
	public $vpmcEnabled;

	/** @var ScheduledHardwareUpgradeInfo $scheduledHardwareUpgradeInfo */
	public $scheduledHardwareUpgradeInfo;
}
