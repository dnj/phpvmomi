<?php

namespace dnj\phpvmomi\DataObjects;

/**
 * @todo recheck and complete
 *
 * @see https://vdc-download.vmware.com/vmwb-repository/dcr-public/b50dcbbf-051d-4204-a3e7-e1b618c1e384/538cf2ec-b34f-4bae-a332-3820ef9e7773/vim.vm.ConfigSpec.html
 */
class VirtualMachineConfigSpec extends DynamicData
{
    /** @var string */
    public $changeVersion;

    /** @var string */
    public $name;

    /** @var string */
    public $version;

    /** @var string */
    public $uuid;

    /** @var string */
    public $instanceUuid;

    /** @var array */
    public $npivNodeWorldWideName;

    /** @var array */
    public $npivPortWorldWideName;

    /** @var string */
    public $npivWorldWideNameType;

    /** @var int */
    public $npivDesiredNodeWwns;

    /** @var int */
    public $npivDesiredPortWwns;

    /** @var bool */
    public $npivTemporaryDisabled;

    /** @var bool */
    public $npivOnNonRdmDisks;

    /** @var string */
    public $npivWorldWideNameOp;

    /** @var string */
    public $locationId;

    /** @var string */
    public $guestId;

    /** @var string */
    public $alternateGuestName;

    /** @var string */
    public $annotation;

    /** @var VirtualMachineFileInfo */
    public $files;

    /** @var ToolsConfigInfo */
    public $tools;

    /** @var VirtualMachineFlagInfo */
    public $flags;

    /** @var VirtualMachineConsolePreferences */
    public $consolePreferences;

    /** @var VirtualMachineDefaultPowerOpInfo */
    public $powerOpInfo;

    /** @var int */
    public $numCPUs;

    /** @var int */
    public $numCoresPerSocket;

    /** @var int */
    public $memoryMB;

    /** @var bool */
    public $memoryHotAddEnabled;

    /** @var bool */
    public $cpuHotAddEnabled;

    /** @var bool */
    public $cpuHotRemoveEnabled;

    /** @var bool */
    public $virtualICH7MPresent;

    /** @var bool */
    public $virtualSMCPresent;

    /** @var VirtualDeviceConfigSpec[] */
    public $deviceChange;

    /** @var ResourceAllocationInfo */
    public $cpuAllocation;

    /** @var ResourceAllocationInfo */
    public $memoryAllocation;

    /** @var LatencySensitivity */
    public $latencySensitivity;

    /** @var VirtualMachineAffinityInfo */
    public $cpuAffinity;

    /** @var VirtualMachineAffinityInfo */
    public $memoryAffinity;

    /** @var VirtualMachineNetworkShaperInfo */
    public $networkShaper;

    /** @var VirtualMachineCpuIdInfoSpec[] */
    public $cpuFeatureMask;

    /** @var OptionValue[] */
    public $extraConfig;

    /** @var string */
    public $swapPlacement;

    /** @var VirtualMachineBootOptions */
    public $bootOptions;

    /** @var VmConfigSpec */
    public $vAppConfig;

    /** @var FaultToleranceConfigInfo */
    public $ftInfo;

    /** @var bool */
    public $vAppConfigRemoved;

    /** @var bool */
    public $vAssertsEnabled;

    /** @var bool */
    public $changeTrackingEnabled;

    /** @var string */
    public $firmware;

    /** @var int */
    public $maxMksConnections;

    /** @var bool */
    public $guestAutoLockEnabled;

    /** @var ManagedByInfo */
    public $managedBy;

    /** @var bool */
    public $memoryReservationLockedToMax;

    /** @var bool */
    public $nestedHVEnabled;

    /** @var bool */
    public $vpmcEnabled;

    /** @var ScheduledHardwareUpgradeInfo */
    public $scheduledHardwareUpgradeInfo;
}
