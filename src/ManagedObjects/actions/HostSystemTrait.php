<?php

namespace dnj\phpvmomi\ManagedObjects\actions;

use dnj\phpvmomi\DataObjects\ObjectSpec;
use dnj\phpvmomi\DataObjects\PropertyFilterSpec;
use dnj\phpvmomi\DataObjects\PropertySpec;
use dnj\phpvmomi\DataObjects\SelectionSpec;
use dnj\phpvmomi\DataObjects\TraversalSpec;
use dnj\phpvmomi\Exception;
use dnj\phpvmomi\ManagedObjects\Datacenter;
use dnj\phpvmomi\ManagedObjects\ResourcePool;

trait HostSystemTrait
{
    public function getResourcePool(): ResourcePool
    {
        $propSet = new PropertySpec('ResourcePool');

        $hostWalker = new TraversalSpec('HostSystem', 'parent');
        $hostWalker->name = 'HostWalker';
        $hostWalker->selectSet = [new SelectionSpec('ComputeResourceWalker')];

        $computeResourceWalker = new TraversalSpec('ComputeResource', 'resourcePool');
        $computeResourceWalker->name = 'ComputeResourceWalker';

        $objectSet = new ObjectSpec($this->ref());
        $objectSet->selectSet = [$hostWalker, $computeResourceWalker];
        $spec = new PropertyFilterSpec([$objectSet], [$propSet]);

        $objects = $this->api->getPropertyCollector()->retrieveAllProperties([$spec]);
        if (!$objects) {
            throw new Exception('Can not happening');
        }

        return (new ResourcePool($this->api))->fromObjectContent($objects[0]);
    }

    public function getDatacenter(): Datacenter
    {
        $propSet = new PropertySpec('Datacenter');

        $walker = new TraversalSpec('ManagedEntity', 'parent');
        $walker->name = 'Walker';
        $walker->selectSet = [new SelectionSpec('Walker')];

        $objectSet = new ObjectSpec($this->ref());
        $objectSet->selectSet = [$walker];
        $spec = new PropertyFilterSpec([$objectSet], [$propSet]);

        $objects = $this->api->getPropertyCollector()->retrieveAllProperties([$spec]);
        if (!$objects) {
            throw new Exception('Can not happening');
        }

        return (new Datacenter($this->api))->fromObjectContent($objects[0]);
    }

    /**
     * @return static[]
     */
    public function list(): array
    {
        $propSet = new PropertySpec($this->type());

        $folderWalker = new TraversalSpec('Folder', 'childEntity');
        $folderWalker->name = 'FolderWalker';
        $folderWalker->selectSet = [new SelectionSpec('FolderWalker'), new SelectionSpec('DcWalker'), new SelectionSpec('ComputeResourceWalker')];

        $dcWalker = new TraversalSpec('Datacenter', 'hostFolder');
        $dcWalker->name = 'DcWalker';
        $dcWalker->selectSet = [new SelectionSpec('FolderWalker')];

        $computeResourceWalker = new TraversalSpec('ComputeResource', 'host');
        $computeResourceWalker->name = 'ComputeResourceWalker';

        $objectSet = new ObjectSpec($this->api->getServiceContent()->rootFolder);
        $objectSet->selectSet = [$folderWalker, $dcWalker, $computeResourceWalker];
        $spec = new PropertyFilterSpec([$objectSet], [$propSet]);
        $objects = $this->api->getPropertyCollector()->retrieveAllProperties([$spec]);

        return array_map(fn ($item) => $this->createNew()->fromObjectContent($item), $objects);
    }
}
