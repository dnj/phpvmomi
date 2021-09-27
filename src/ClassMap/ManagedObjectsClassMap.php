<?php

namespace dnj\phpvmomi\ClassMap;

use dnj\phpvmomi\ManagedObjects;

class ManagedObjectsClassMap
{
    public const CLASS_MAP = [
        'Datacenter' => ManagedObjects\Datacenter::class,
        'Datastore' => ManagedObjects\Datastore::class,
        'ExtensibleManagedObject' => ManagedObjects\ExtensibleManagedObject::class,
        'FileManager' => ManagedObjects\FileManager::class,
        'Folder' => ManagedObjects\Folder::class,
        'HostSystem' => ManagedObjects\HostSystem::class,
        'ManagedEntity' => ManagedObjects\ManagedEntity::class,
        'Network' => ManagedObjects\Network::class,
        'PropertyCollector' => ManagedObjects\PropertyCollector::class,
        'PropertyFilter' => ManagedObjects\PropertyFilter::class,
        'ServiceInstance' => ManagedObjects\ServiceInstance::class,
        'SessionManager' => ManagedObjects\SessionManager::class,
        'Task' => ManagedObjects\Task::class,
        'ViewManager' => ManagedObjects\ViewManager::class,
        'VirtualMachine' => ManagedObjects\VirtualMachine::class,
    ];
}
