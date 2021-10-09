<?php

namespace dnj\phpvmomi\ManagedObjects\actions;

use dnj\phpvmomi\DataObjects\ObjectSpec;
use dnj\phpvmomi\DataObjects\PropertyFilterSpec;
use dnj\phpvmomi\DataObjects\PropertySpec;
use dnj\phpvmomi\DataObjects\SelectionSpec;
use dnj\phpvmomi\DataObjects\TraversalSpec;
use dnj\phpvmomi\Exception;
use dnj\phpvmomi\ManagedObjects\Datacenter;
use dnj\phpvmomi\Utils\Path;

trait DatastoreTrait
{
    protected ?Datacenter $datacenter = null;

    /**
     * @return static[]
     */
    public function list(): array
    {
        $propSet = new PropertySpec('Datastore');

        $folderWalker = new TraversalSpec('Folder', 'childEntity');
        $folderWalker->name = 'FolderWalker';
        $folderWalker->selectSet = [new SelectionSpec('FolderWalker'), new SelectionSpec('dcWalker')];

        $dcWalker = new TraversalSpec('Datacenter', 'datastoreFolder');
        $dcWalker->name = 'dcWalker';
        $dcWalker->skip = false;
        $dcWalker->selectSet = [new SelectionSpec('FolderWalker')];

        $objectSet = new ObjectSpec($this->api->getServiceContent()->rootFolder);
        $objectSet->selectSet = [$folderWalker, $dcWalker];
        $spec = new PropertyFilterSpec([$objectSet], [$propSet]);
        $objects = $this->api->getPropertyCollector()->retrieveAllProperties([$spec]);

        return array_map(fn ($item) => $this->createNew()->fromObjectContent($item), $objects);
    }

    public function getDatacenter(): Datacenter
    {
        if ($this->datacenter) {
            return $this->datacenter;
        }
        $propSet = new PropertySpec('Datacenter');

        $parentWalker = new TraversalSpec('ManagedEntity', 'parent');
        $parentWalker->name = 'ParentWalker';
        $parentWalker->skip = false;
        $parentWalker->selectSet = [new SelectionSpec('ParentWalker')];

        $objectSet = new ObjectSpec($this->ref());
        $objectSet->selectSet = [$parentWalker];

        $spec = new PropertyFilterSpec([$objectSet], [$propSet]);
        $objects = $this->api->getPropertyCollector()->retrieveAllProperties([$spec]);

        if (!$objects) {
            throw new Exception('Cannot happening');
        }
        $this->datacenter = (new Datacenter($this->api))->fromObjectContent($objects[0]);

        return $this->datacenter;
    }

    public function getDatastorePath(string $path): string
    {
        return (new Path($this->name, $path))->toDSPath();
    }

    public function getPath(string $path): Path
    {
        return new Path($this->name, $path, $this->getDatacenter()->name);
    }

    public function getFileURL(string $path): string
    {
        return $this->getPath($path)->toURL($this->api);
    }

    public function makeDirectory(string $path, bool $createParentDirectories = false): void
    {
        $this->api->getFileManager()->_MakeDirectory("[{$this->info->name}] $path", $createParentDirectories);
    }
}
