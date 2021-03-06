<?php

namespace dnj\phpvmomi\DataObjects;

class ManagedObjectReference extends DynamicData
{
    use actions\ManagedObjectReferenceTrait;
    /**
     * @var string the specific instance of Managed Object this ManagedObjectReference refers to
     */
    public $_;

    /**
     * Allowable values are:
     * 	Alarm
     *  AlarmManager
     *  AuthorizationManager
     *  ClusterComputeResource
     *  ComputeResource
     *  CustomFieldsManager
     *  CustomizationSpecManager
     *  Datacenter
     *  Datastore
     *  DiagnosticManager
     *  EnvironmentBrowser
     *  EventHistoryCollector
     *  EventManager
     *  Folder
     *  HistoryCollector
     *  HostAutoStartManager
     *  HostCpuSchedulerSystem
     *  HostDatastoreBrowser
     *  HostDatastoreSystem
     *  HostDiagnosticSystem
     *  HostDiskManagerLease
     *  HostFirewallSystem
     *  HostLocalAccountManager
     *  HostMemorySystem
     *  HostNetworkSystem
     *  HostServiceSystem
     *  HostSnmpSystem
     *  HostStorageSystem
     *  HostSystem
     *  HostVMotionSystem
     *  LicenseManager
     *  ManagedEntity
     *  Network
     *  OptionManager
     *  PerformanceManager
     *  PropertyCollector
     *  PropertyFilter
     *  ResourcePool
     *  ScheduledTask
     *  ScheduledTaskManager
     *  SearchIndex
     *  ServiceInstance
     *  SessionManager
     *  Task
     *  TaskHistoryCollector
     *  TaskManager
     *  UserDirectory
     *  VirtualMachine
     *  VirtualMachineSnapshot.
     *
     * @var string the name of the Managed Object type this ManagedObjectReference refers to
     */
    public $type;

    public function __construct(string $type, string $value)
    {
        $this->type = $type;
        $this->_ = $value;
    }
}
