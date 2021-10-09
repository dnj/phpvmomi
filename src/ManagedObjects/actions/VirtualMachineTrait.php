<?php

namespace dnj\phpvmomi\ManagedObjects\actions;

use dnj\phpvmomi\DataObjects\ObjectSpec;
use dnj\phpvmomi\DataObjects\PropertyFilterSpec;
use dnj\phpvmomi\DataObjects\PropertySpec;
use dnj\phpvmomi\DataObjects\SelectionSpec;
use dnj\phpvmomi\DataObjects\TraversalSpec;
use dnj\phpvmomi\Exception;
use dnj\phpvmomi\ManagedObjects\ResourcePool;

trait VirtualMachineTrait
{
    public function getResourcePool(): ResourcePool
    {
        if ($this->resourcePool) {
            return $this->resourcePool->get($this->api);
        }
        $propSet = new PropertySpec('ResourcePool');

        $vmWalker = new TraversalSpec('VirtualMachine', 'runtime.host');
        $vmWalker->name = 'VMWalker';
        $vmWalker->selectSet = [new SelectionSpec('HostWalker')];

        $hostWalker = new TraversalSpec('HostSystem', 'parent');
        $hostWalker->name = 'HostWalker';
        $hostWalker->selectSet = [new SelectionSpec('ComputeResourceWalker')];

        $computeResourceWalker = new TraversalSpec('ComputeResource', 'resourcePool');
        $computeResourceWalker->name = 'ComputeResourceWalker';

        $objectSet = new ObjectSpec($this->ref());
        $objectSet->selectSet = [$vmWalker, $hostWalker, $computeResourceWalker];
        $spec = new PropertyFilterSpec([$objectSet], [$propSet]);

        $objects = $this->api->getPropertyCollector()->retrieveAllProperties([$spec]);
        if (!$objects) {
            throw new Exception('Can not happening');
        }

        return (new ResourcePool($this->api))->fromObjectContent($objects[0]);
    }

    /**
     * @return static[]
     */
    public function list(): array
    {
        $propSet = new PropertySpec($this->type());

        $folderWalker = new TraversalSpec('Folder', 'childEntity');
        $folderWalker->name = 'FolderWalker';
        $folderWalker->skip = false;
        $folderWalker->selectSet = [new SelectionSpec('FolderWalker'), new SelectionSpec('DcWalker')];

        $dcWalker = new TraversalSpec('Datacenter', 'vmFolder');
        $dcWalker->name = 'DcWalker';
        $dcWalker->skip = false;
        $dcWalker->selectSet = [new SelectionSpec('FolderWalker')];

        $objectSet = new ObjectSpec($this->api->getServiceContent()->rootFolder);
        $objectSet->selectSet = [$folderWalker, $dcWalker];
        $spec = new PropertyFilterSpec([$objectSet], [$propSet]);
        $objects = $this->api->getPropertyCollector()->retrieveAllProperties([$spec]);

        return array_map(fn ($item) => $this->createNew()->fromObjectContent($item), $objects);
    }

    public function isOn(): bool
    {
        return isset($this->runtime->powerState) and 'poweredOn' == $this->runtime->powerState;
    }

    public function isOff(): bool
    {
        return isset($this->runtime->powerState) and 'poweredOff' == $this->runtime->powerState;
    }

    public function isSuspend(): bool
    {
        return isset($this->runtime->powerState) and 'suspend' == $this->runtime->powerState;
    }
}
