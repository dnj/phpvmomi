<?php

namespace dnj\phpvmomi\DataObjects;

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
     * @var ManagedObjectReference
     */
    public $accountManager;

    /**
     * @var ManagedObjectReference
     */
    public $alarmManager;

    /**
     * @var ManagedObjectReference
     */
    public $authorizationManager;

    /**
     * @var ManagedObjectReference
     */
    public $certificateManager;

    /**
     * @var ManagedObjectReference
     */
    public $clusterProfileManager;

    /**
     * @var ManagedObjectReference
     */
    public $complianceManager;

    /**
     * @var ManagedObjectReference
     */
    public $cryptoManager;

    /**
     * @var ManagedObjectReference
     */
    public $customFieldsManager;

    /**
     * @var ManagedObjectReference
     */
    public $customizationSpecManager;

    /**
     * @var ManagedObjectReference
     */
    public $datastoreNamespaceManager;

    /**
     * @var ManagedObjectReference
     */
    public $diagnosticManager;

    /**
     * @var ManagedObjectReference
     */
    public $dvSwitchManager;

    /**
     * @var ManagedObjectReference
     */
    public $eventManager;

    /**
     * @var ManagedObjectReference
     */
    public $extensionManager;

    /**
     * @var ManagedObjectReference
     */
    public $failoverClusterConfigurator;

    /**
     * @var ManagedObjectReference
     */
    public $failoverClusterManager;

    /**
     * @var ManagedObjectReference
     */
    public $fileManager;

    /**
     * @var ManagedObjectReference
     */
    public $guestCustomizationManager;

    /**
     * @var ManagedObjectReference
     */
    public $guestOperationsManager;

    /**
     * @var ManagedObjectReference
     */
    public $healthUpdateManager;

    /**
     * @var ManagedObjectReference
     */
    public $hostProfileManager;

    /**
     * @var ManagedObjectReference
     */
    public $hostSpecManager;

    /**
     * @var ManagedObjectReference
     */
    public $ioFilterManager;

    /**
     * @var ManagedObjectReference
     */
    public $ipPoolManager;

    /**
     * @var ManagedObjectReference
     */
    public $licenseManager;

    /**
     * @var ManagedObjectReference
     */
    public $localizationManager;

    /**
     * @var ManagedObjectReference
     */
    public $overheadMemoryManager;

    /**
     * @var ManagedObjectReference
     */
    public $ovfManager;

    /**
     * @var ManagedObjectReference
     */
    public $perfManager;

    /**
     * @var ManagedObjectReference
     */
    public $propertyCollector;

    /**
     * @var ManagedObjectReference
     */
    public $rootFolder;

    /**
     * @var ManagedObjectReference
     */
    public $scheduledTaskManager;

    /**
     * @var ManagedObjectReference
     */
    public $searchIndex;

    /**
     * @var ManagedObjectReference
     */
    public $serviceManager;

    /**
     * @var ManagedObjectReference
     */
    public $sessionManager;

    /**
     * @var ManagedObjectReference
     */
    public $setting;

    /**
     * @var ManagedObjectReference
     */
    public $siteInfoManager;

    /**
     * @var ManagedObjectReference
     */
    public $snmpSystem;

    /**
     * @var ManagedObjectReference
     */
    public $storageQueryManager;

    /**
     * @var ManagedObjectReference
     */
    public $storageResourceManager;

    /**
     * @var ManagedObjectReference
     */
    public $taskManager;

    /**
     * @var ManagedObjectReference
     */
    public $tenantManager;

    /**
     * @var ManagedObjectReference
     */
    public $userDirectory;

    /**
     * @var ManagedObjectReference
     */
    public $viewManager;

    /**
     * @var ManagedObjectReference
     */
    public $virtualDiskManager;

    /**
     * @var ManagedObjectReference
     */
    public $virtualizationManager;

    /**
     * @var ManagedObjectReference
     */
    public $vmCompatibilityChecker;

    /**
     * @var ManagedObjectReference
     */
    public $vmProvisioningChecker;

    /**
     * @var ManagedObjectReference
     */
    public $vStorageObjectManager;
}
