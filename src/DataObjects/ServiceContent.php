<?php
namespace DNJ\PHPVMOMI\DataObjects;

use DNJ\PHPVMOMI\ManagedObjects;
use DNJ\PHPVMOMI\ManagedObjects\ManagedObjectReference;

/**
 * The ServiceContent data object defines properties for the ServiceInstance managed object. The ServiceInstance itself does not have directly-accessible properties because reading the properties of a managed object requires the use of a property collector, and the property collector itself is a property of the ServiceInstance. For this reason, use the method RetrieveServiceContent to retrieve the ServiceContent object.
 *
 * @see https://vdc-download.vmware.com/vmwb-repository/dcr-public/b50dcbbf-051d-4204-a3e7-e1b618c1e384/538cf2ec-b34f-4bae-a332-3820ef9e7773/vim.ServiceInstanceContent.html
 */
class ServiceContent extends DynamicData
{
	/**
	 * @var AboutInfo $about Information about the service, such as the software version.
	 */
	public $about;

	/**
	 * @var ManagedObjectReference<ManagedObjects\HostLocalAccountManager> $accountManager
	 */
	public $accountManager;

	/**
	 * @var ManagedObjectReference<ManagedObjects\AlarmManager> $alarmManager
	 */
	public $alarmManager;

	/**
	 * @var ManagedObjectReference<ManagedObjects\AuthorizationManager> $authorizationManager
	 */
	public $authorizationManager;

	/**
	 * @var ManagedObjectReference<ManagedObjects\CertificateManager> $certificateManager
	 */
	public $certificateManager;

	/**
	 * @var ManagedObjectReference<ManagedObjects\ClusterProfileManager> $clusterProfileManager
	 */
	public $clusterProfileManager;

	/**
	 * @var ManagedObjectReference<ManagedObjects\ProfileComplianceManager> $complianceManager
	 */
	public $complianceManager;

	/**
	 * @var ManagedObjectReference<ManagedObjects\CryptoManager> $cryptoManager
	 */
	public $cryptoManager;

	/**
	 * @var ManagedObjectReference<ManagedObjects\CustomFieldsManager> $customFieldsManager
	 */
	public $customFieldsManager;

	/**
	 * @var ManagedObjectReference<ManagedObjects\CustomizationSpecManager> $customizationSpecManager
	 */
	public $customizationSpecManager;

	/**
	 * @var ManagedObjectReference<ManagedObjects\DatastoreNamespaceManager> $datastoreNamespaceManager
	 */
	public $datastoreNamespaceManager;

	/**
	 * @var ManagedObjectReference<ManagedObjects\DiagnosticManager> $diagnosticManager
	 */
	public $diagnosticManager;

	/**
	 * @var ManagedObjectReference<ManagedObjects\DistributedVirtualSwitchManager> $dvSwitchManager
	 */
	public $dvSwitchManager;

	/**
	 * @var ManagedObjectReference<ManagedObjects\EventManager> $eventManager
	 */
	public $eventManager;

	/**
	 * @var ManagedObjectReference<ManagedObjects\ExtensionManager> $extensionManager
	 */
	public $extensionManager;

	/**
	 * @var ManagedObjectReference<ManagedObjects\FailoverClusterConfigurator> $failoverClusterConfigurator
	 */
	public $failoverClusterConfigurator;

	/**
	 * @var ManagedObjectReference<ManagedObjects\FailoverClusterManager> $failoverClusterManager
	 */
	public $failoverClusterManager;

	/**
	 * @var ManagedObjectReference<ManagedObjects\FileManager> $fileManager
	 */
	public $fileManager;

	/**
	 * @var ManagedObjectReference<ManagedObjects\VirtualMachineGuestCustomizationManager> $guestCustomizationManager
	 */
	public $guestCustomizationManager;

	/**
	 * @var ManagedObjectReference<ManagedObjects\GuestOperationsManager> $guestOperationsManager
	 */
	public $guestOperationsManager;

	/**
	 * @var ManagedObjectReference<ManagedObjects\HealthUpdateManager> $healthUpdateManager
	 */
	public $healthUpdateManager;

	/**
	 * @var ManagedObjectReference<ManagedObjects\HostProfileManager> $hostProfileManager
	 */
	public $hostProfileManager;

	/**
	 * @var ManagedObjectReference<ManagedObjects\HostSpecificationManager> $hostSpecManager
	 */
	public $hostSpecManager;

	/**
	 * @var ManagedObjectReference<ManagedObjects\IoFilterManager> $ioFilterManager
	 */
	public $ioFilterManager;

	/**
	 * @var ManagedObjectReference<ManagedObjects\IpPoolManager> $ipPoolManager
	 */
	public $ipPoolManager;

	/**
	 * @var ManagedObjectReference<ManagedObjects\LicenseManager> $licenseManager
	 */
	public $licenseManager;

	/**
	 * @var ManagedObjectReference<ManagedObjects\LocalizationManager> $localizationManager
	 */
	public $localizationManager;

	/**
	 * @var ManagedObjectReference<ManagedObjects\OverheadMemoryManager> $overheadMemoryManager
	 */
	public $overheadMemoryManager;

	/**
	 * @var ManagedObjectReference<ManagedObjects\OvfManager> $ovfManager
	 */
	public $ovfManager;

	/**
	 * @var ManagedObjectReference<ManagedObjects\PerformanceManager> $perfManager
	 */
	public $perfManager;

	/**
	 * @var ManagedObjectReference<ManagedObjects\PropertyCollector> $propertyCollector
	 */
	public $propertyCollector;

	/**
	 * @var ManagedObjectReference<ManagedObjects\Folder> $rootFolder
	 */
	public $rootFolder;

	/**
	 * @var ManagedObjectReference<ManagedObjects\ScheduledTaskManager> $scheduledTaskManager
	 */
	public $scheduledTaskManager;

	/**
	 * @var ManagedObjectReference<ManagedObjects\SearchIndex> $searchIndex
	 */
	public $searchIndex;

	/**
	 * @var ManagedObjectReference<ManagedObjects\ServiceManager> $serviceManager
	 */
	public $serviceManager;

	/**
	 * @var ManagedObjectReference<ManagedObjects\SessionManager> $sessionManager
	 */
	public $sessionManager;

	/**
	 * @var ManagedObjectReference<ManagedObjects\OptionManager> $setting
	 */
	public $setting;

	/**
	 * @var ManagedObjectReference<ManagedObjects\SiteInfoManager> $siteInfoManager
	 */
	public $siteInfoManager;

	/**
	 * @var ManagedObjectReference<ManagedObjects\HostSnmpSystem> $snmpSystem
	 */
	public $snmpSystem;

	/**
	 * @var ManagedObjectReference<ManagedObjects\StorageQueryManager> $storageQueryManager
	 */
	public $storageQueryManager;

	/**
	 * @var ManagedObjectReference<ManagedObjects\StorageResourceManager> $storageResourceManager
	 */
	public $storageResourceManager;

	/**
	 * @var ManagedObjectReference<ManagedObjects\TaskManager> $taskManager
	 */
	public $taskManager;

	/**
	 * @var ManagedObjectReference<ManagedObjects\TenantTenantManager> $tenantManager
	 */
	public $tenantManager;

	/**
	 * @var ManagedObjectReference<ManagedObjects\UserDirectory> $userDirectory
	 */
	public $userDirectory;

	/**
	 * @var ManagedObjectReference<ManagedObjects\ViewManager> $viewManager
	 */
	public $viewManager;

	/**
	 * @var ManagedObjectReference<ManagedObjects\VirtualDiskManager> $virtualDiskManager
	 */
	public $virtualDiskManager;

	/**
	 * @var ManagedObjectReference<ManagedObjects\VirtualizationManager> $virtualizationManager
	 */
	public $virtualizationManager;

	/**
	 * @var ManagedObjectReference<ManagedObjects\VirtualMachineCompatibilityChecker> $vmCompatibilityChecker
	 */
	public $vmCompatibilityChecker;

	/**
	 * @var ManagedObjectReference<ManagedObjects\VirtualMachineProvisioningChecker> $vmProvisioningChecker
	 */
	public $vmProvisioningChecker;

	/**
	 * @var ManagedObjectReference<ManagedObjects\VStorageObjectManagerBase> $vStorageObjectManager
	 */
	public $vStorageObjectManager;

}
