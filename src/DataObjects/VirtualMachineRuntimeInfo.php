<?php
namespace dnj\phpvmomi\DataObjects;

/**
 * The RuntimeInfo data object type provides information about the execution state and history of a virtual machine.
 */
class VirtualMachineRuntimeInfo extends DynamicData
{
	/**
	 * This property is updated when the virtual machine is powered on from the poweredOff state, and is cleared when the virtual machine is powered off. This property is not updated when a virtual machine is resumed from a suspended state. 
	 * 
	 * @var int|null The timestamp when the virtual machine was most recently powered on.
	 */
	public $bootTime;

	/**
	 * @var bool|null For a powered off virtual machine, indicates whether the virtual machine's last shutdown was an orderly power off or not. Unset if the virtual machine is running or suspended.
	 */
	public $cleanPowerOff;

	/**
	 * @var \stdClass Indicates whether or not the virtual machine is available for management. 
	 * @since vSphere API 4.0
	 */
	public $connectionState;

	/**
	 * @var bool Whether any disk of the virtual machine requires consolidation. This can happen for example when a snapshot is deleted but its associated disk is not committed back to the base disk. Use ConsolidateVMDisks_Task to consolidate if needed.
	 * @since vSphere API 5.0
	 */
	public $consolidationNeeded;

	/**
	 * @var \stdClass The vSphere HA protection state for a virtual machine. Property is unset if vSphere HA is not enabled.
	 * @since vSphere API 5.0
	 */
	public $dasVmProtection;

	/**
	 * @var \stdClass[] Per-device runtime info. This array will be empty if the host software does not provide runtime info for any of the device types currently in use by the virtual machine. In releases after vSphere API 5.0, vSphere Servers might not generate property collector update notifications for this property. To obtain the latest value of the property, you can use PropertyCollector methods RetrievePropertiesEx or WaitForUpdatesEx. If you use the PropertyCollector.WaitForUpdatesEx method, specify an empty string for the version parameter. Since this property is on a DataObject, an update returned by WaitForUpdatesEx may contain values for this property when some other property on the DataObject changes. If this update is a result of a call to WaitForUpdatesEx with a non-empty version parameter, the value for this property may not be current.
	 * @since vSphere API 4.1
	 */
	public $device;

	/**
	 * @var string The fault tolerance state of the virtual machine.
	 * @since vSphere API 4.0
	 */
	public $faultToleranceState;

	/**
	 * @var \stdClass[] The masks applied to an individual virtual machine as a result of its configuration.
	 * @since vSphere API 5.1
	 */
	public $featureMask;

	/**
	 * @var \stdClass[] These requirements must have equivalent host capabilities featureCapability in order to power on, resume, or migrate to the host.
	 * @since vSphere API 5.1
	 */
	public $featureRequirement;

	/**
	 * @var ManagedObjectReference<HostSystem> The host that is responsible for running a virtual machine. This property is null if the virtual machine is not running and is not assigned to run on a particular host. 
	 * @since vSphere API 5.1
	 */
	public $host;

	/**
	 * @var int Current upper-bound on CPU usage. The upper-bound is based on the host the virtual machine is current running on, as well as limits configured on the virtual machine itself or any parent resource pool.
	 */
	public $maxCpuUsage;

	/**
	 * @var int Current upper-bound on memory usage. The upper-bound is based on memory configuration of the virtual machine, as well as limits configured on the virtual machine itself or any parent resource pool.
	 */
	public $maxMemoryUsage;

	/**
	 * @deprecated As of vSphere API 4.1, use the PerformanceManager memory overhead counter to get this value.
	 * @var int The amount of memory resource (in bytes) that will be used by the virtual machine above its guest memory requirements. This value is set if and only if the virtual machine is registered on a host that supports memory resource allocation features.
	 */
	public $memoryOverhead;

	/**
	 * @var string For a powered-on or suspended virtual machine in a cluster with Enhanced VMotion Compatibility (EVC) enabled, this identifies the least-featured EVC mode (among those for the appropriate CPU vendor) that could admit the virtual machine.
	 * @since vSphere API 4.1
	 */
	public $minRequiredEVCModeKey;

	/**
	 * @var string If set, indicates the reason the virtual machine needs a secondary.
	 * @since vSphere API 4.0
	 */
	public $needSecondaryReason;

	/**
	 * @var int Number of active MKS connections to this virtual machine.
	 */
	public $numMksConnections;

	/**
	 * @var \stdClass[] These requirements must have equivalent host capabilities featureCapability in order to power on.
	 * @since vSphere API 5.1
	 */
	public $offlineFeatureRequirement;

	/**
	 * @var string The current power state of the virtual machine.
	 */
	public $powerState;

	/**
	 * @var \stdClass The current question, if any, that is blocking the virtual machine's execution.
	 */
	public $question;

	/**
	 * @var \stdClass Record / replay state of this virtual machine.
	 * @since vSphere API 4.0
	 */
	public $recordReplayState;

	/**
	 * @var int The total time the virtual machine has been suspended since it was initially powered on. This time excludes the current period, if the virtual machine is currently suspended. This property is updated when the virtual machine resumes, and is reset to zero when the virtual machine is powered off. 
	 */
	public $suspendInterval;

	/**
	 * @var int Specifies the total allocated vFlash resource for the vFlash caches associated with VM's VMDKs when VM is powered on, in bytes.
	 * @since vSphere API 5.5
	 */
	public $vFlashCacheAllocation;
}
