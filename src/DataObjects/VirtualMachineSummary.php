<?php
namespace dnj\phpvmomi\DataObjects;

/**
 * The summary data object type encapsulates a typical set of virtual machine information that is useful for list views and summary pages.
 * VirtualCenter can retrieve this information very efficiently, even for large sets of virtual machines.
 */
class VirtualMachineSummary extends DynamicData
{
	/**
	 * @var DynamicData Basic configuration information about the virtual machine. This information is not available when the virtual machine is unavailable, for instance, when it is being created or deleted. 
	 */
	public $config;

	/**
	 * @var DynamicData[] Custom field values.
	 */
	public $customValue;

	/**
	 * @var DynamicData Guest operating system and VMware Tools information. See guest for more information.
	 */
	public $guest;

	/**
	 * @var DynamicData Overall alarm status on this node. In releases after vSphere API 5.0, vSphere Servers might not generate property collector update notifications for this property. To obtain the latest value of the property, you can use PropertyCollector methods RetrievePropertiesEx or WaitForUpdatesEx. If you use the PropertyCollector.WaitForUpdatesEx method, specify an empty string for the version parameter. Since this property is on a DataObject, an update returned by WaitForUpdatesEx may contain values for this property when some other property on the DataObject changes. If this update is a result of a call to WaitForUpdatesEx with a non-empty version parameter, the value for this property may not be current. 
	 */
	public $overallStatus;

	/**
	 * @var DynamicData A set of statistics that are typically updated with near real-time regularity. This data object type does not support notification, for scalability reasons. Therefore, changes in QuickStats do not generate property collector updates. To monitor statistics values, use the statistics and alarms modules instead. 
	 */
	public $quickStats;

	/**
	 * @var VirtualMachineRuntimeInfo Runtime and state information of a running virtual machine. Most of this information is also available when a virtual machine is powered off. In that case, it contains information from the last run, if available. 
	 */
	public $runtime;

	/**
	 * @var DynamicData Storage information of the virtual machine. It can be explicitly refreshed with the RefreshStorageInfo operation. In releases after vSphere API 5.0, vSphere Servers might not generate property collector update notifications for this property. To obtain the latest value of the property, you can use PropertyCollector methods RetrievePropertiesEx or WaitForUpdatesEx. If you use the PropertyCollector.WaitForUpdatesEx method, specify an empty string for the version parameter. Since this property is on a DataObject, an update returned by WaitForUpdatesEx may contain values for this property when some other property on the DataObject changes. If this update is a result of a call to WaitForUpdatesEx with a non-empty version parameter, the value for this property may not be current.
	 * @since vSphere API 4.0
	 */
	public $storage;

	/**
	 * @var ManagedObjectReference Reference to the virtual machine managed object.
	 */
	public $vm;
}
