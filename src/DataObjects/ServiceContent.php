<?php

namespace dnj\phpvmomi\DataObjects;

use dnj\phpvmomi\ManagedObjects;
use dnj\phpvmomi\ManagedObjects\ManagedObjectReference;

/**
 * The ServiceContent data object defines properties for the ServiceInstance managed object. The ServiceInstance itself does not have directly-accessible properties because reading the properties of a managed object requires the use of a property collector, and the property collector itself is a property of the ServiceInstance. For this reason, use the method RetrieveServiceContent to retrieve the ServiceContent object.
 *
 * @see https://vdc-download.vmware.com/vmwb-repository/dcr-public/b50dcbbf-051d-4204-a3e7-e1b618c1e384/538cf2ec-b34f-4bae-a332-3820ef9e7773/vim.ServiceInstanceContent.html
 */
class ServiceContent extends DynamicData
{
    /**
     * @var AboutInfo information about the service, such as the software version
     */
    public $about;

    /**
     * @var ManagedObjectReference<ManagedObjects\HostLocalAccountManager>
     */
    public $accountManager;

    /**
     * @var ManagedObjectReference<ManagedObjects\AlarmManager>
     */
    public $alarmManager;

    /**
     * @var ManagedObjectReference<ManagedObjects\AuthorizationManager>
     */
    public $authorizationManager;

    /**
     * @var ManagedObjectReference<ManagedObjects\CertificateManager>
     */
    public $certificateManager;

    /**
     * @var ManagedObjectReference<ManagedObjects\ClusterProfileManager>
     */
    public $clusterProfileManager;

    /**
     * @var ManagedObjectReference<ManagedObjects\ProfileComplianceManager>
     */
    public $complianceManager;

    /**
     * @var ManagedObjectReference<ManagedObjects\CryptoManager>
     */
    public $cryptoManager;

    /**
     * @var ManagedObjectReference<ManagedObjects\CustomFieldsManager>
     */
    public $customFieldsManager;

    /**
     * @var ManagedObjectReference<ManagedObjects\CustomizationSpecManager>
     */
    public $customizationSpecManager;

    /**
     * @var ManagedObjectReference<ManagedObjects\DatastoreNamespaceManager>
     */
    public $datastoreNamespaceManager;

    /**
     * @var ManagedObjectReference<ManagedObjects\DiagnosticManager>
     */
    public $diagnosticManager;

    /**
     * @var ManagedObjectReference<ManagedObjects\DistributedVirtualSwitchManager>
     */
    public $dvSwitchManager;

    /**
     * @var ManagedObjectReference<ManagedObjects\EventManager>
     */
    public $eventManager;

    /**
     * @var ManagedObjectReference<ManagedObjects\ExtensionManager>
     */
    public $extensionManager;

    /**
     * @var ManagedObjectReference<ManagedObjects\FailoverClusterConfigurator>
     */
    public $failoverClusterConfigurator;

    /**
     * @var ManagedObjectReference<ManagedObjects\FailoverClusterManager>
     */
    public $failoverClusterManager;

    /**
     * @var ManagedObjectReference<ManagedObjects\FileManager>
     */
    public $fileManager;

    /**
     * @var ManagedObjectReference<ManagedObjects\VirtualMachineGuestCustomizationManager>
     */
    public $guestCustomizationManager;

    /**
     * @var ManagedObjectReference<ManagedObjects\GuestOperationsManager>
     */
    public $guestOperationsManager;

    /**
     * @var ManagedObjectReference<ManagedObjects\HealthUpdateManager>
     */
    public $healthUpdateManager;

    /**
     * @var ManagedObjectReference<ManagedObjects\HostProfileManager>
     */
    public $hostProfileManager;

    /**
     * @var ManagedObjectReference<ManagedObjects\HostSpecificationManager>
     */
    public $hostSpecManager;

    /**
     * @var ManagedObjectReference<ManagedObjects\IoFilterManager>
     */
    public $ioFilterManager;

    /**
     * @var ManagedObjectReference<ManagedObjects\IpPoolManager>
     */
    public $ipPoolManager;

    /**
     * @var ManagedObjectReference<ManagedObjects\LicenseManager>
     */
    public $licenseManager;

    /**
     * @var ManagedObjectReference<ManagedObjects\LocalizationManager>
     */
    public $localizationManager;

    /**
     * @var ManagedObjectReference<ManagedObjects\OverheadMemoryManager>
     */
    public $overheadMemoryManager;

    /**
     * @var ManagedObjectReference<ManagedObjects\OvfManager>
     */
    public $ovfManager;

    /**
     * @var ManagedObjectReference<ManagedObjects\PerformanceManager>
     */
    public $perfManager;

    /**
     * @var ManagedObjectReference<ManagedObjects\PropertyCollector>
     */
    public $propertyCollector;

    /**
     * @var ManagedObjectReference<ManagedObjects\Folder>
     */
    public $rootFolder;

    /**
     * @var ManagedObjectReference<ManagedObjects\ScheduledTaskManager>
     */
    public $scheduledTaskManager;

    /**
     * @var ManagedObjectReference<ManagedObjects\SearchIndex>
     */
    public $searchIndex;

    /**
     * @var ManagedObjectReference<ManagedObjects\ServiceManager>
     */
    public $serviceManager;

    /**
     * @var ManagedObjectReference<ManagedObjects\SessionManager>
     */
    public $sessionManager;

    /**
     * @var ManagedObjectReference<ManagedObjects\OptionManager>
     */
    public $setting;

    /**
     * @var ManagedObjectReference<ManagedObjects\SiteInfoManager>
     */
    public $siteInfoManager;

    /**
     * @var ManagedObjectReference<ManagedObjects\HostSnmpSystem>
     */
    public $snmpSystem;

    /**
     * @var ManagedObjectReference<ManagedObjects\StorageQueryManager>
     */
    public $storageQueryManager;

    /**
     * @var ManagedObjectReference<ManagedObjects\StorageResourceManager>
     */
    public $storageResourceManager;

    /**
     * @var ManagedObjectReference<ManagedObjects\TaskManager>
     */
    public $taskManager;

    /**
     * @var ManagedObjectReference<ManagedObjects\TenantTenantManager>
     */
    public $tenantManager;

    /**
     * @var ManagedObjectReference<ManagedObjects\UserDirectory>
     */
    public $userDirectory;

    /**
     * @var ManagedObjectReference<ManagedObjects\ViewManager>
     */
    public $viewManager;

    /**
     * @var ManagedObjectReference<ManagedObjects\VirtualDiskManager>
     */
    public $virtualDiskManager;

    /**
     * @var ManagedObjectReference<ManagedObjects\VirtualizationManager>
     */
    public $virtualizationManager;

    /**
     * @var ManagedObjectReference<ManagedObjects\VirtualMachineCompatibilityChecker>
     */
    public $vmCompatibilityChecker;

    /**
     * @var ManagedObjectReference<ManagedObjects\VirtualMachineProvisioningChecker>
     */
    public $vmProvisioningChecker;

    /**
     * @var ManagedObjectReference<ManagedObjects\VStorageObjectManagerBase>
     */
    public $vStorageObjectManager;
}
