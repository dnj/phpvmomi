<?php
namespace DNJ\PHPVMOMI\ClassMap;

use DNJ\PHPVMOMI\ManagedObjects;

class ManagedObjectsClassMap
{
	const CLASS_MAP = [
		'Datacenter' => ManagedObjects\Datacenter::class,
		'Datastore' => ManagedObjects\Datastore::class,
		'ExtensibleManagedObject' => ManagedObjects\ExtensibleManagedObject::class,
		'FileManager' => ManagedObjects\FileManager::class,
		'Folder' => ManagedObjects\Folder::class,
		'ManagedEntity' => ManagedObjects\ManagedEntity::class,
		'PropertyCollector' => ManagedObjects\PropertyCollector::class,
		'PropertyFilter' => ManagedObjects\PropertyFilter::class,
		'ServiceInstance' => ManagedObjects\ServiceInstance::class,
		'SessionManager' => ManagedObjects\SessionManager::class,
		'Task' => ManagedObjects\Task::class,
		'VirtualMachine' => ManagedObjects\VirtualMachine::class,
	];
}
