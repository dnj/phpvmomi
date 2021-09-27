<?php

namespace dnj\phpvmomi\ManagedObjects\actions;

use dnj\phpvmomi\API;
use dnj\phpvmomi\DataObjects\DynamicData;
use dnj\phpvmomi\Exception;
use dnj\phpvmomi\ManagedObjects\Custom\File;
use dnj\phpvmomi\ManagedObjects\Datacenter;
use dnj\phpvmomi\ManagedObjects\Datastore;
use SoapVar;

trait DatastoreTrait
{
    public $vmfs;

    /**
     * @var string
     */
    public $id;

    public function list()
    {
        $response = $this->api->getPropertyCollector()->_RetrievePropertiesEx([
            'propSet' => [
                'type' => 'Datastore',
                'all' => true,
            ],
            'objectSet' => [
                'obj' => $this->api->getServiceContent()->rootFolder,
                'skip' => false,
                'selectSet' => [
                    new SoapVar([
                        'name' => 'FolderTraversalSpec',
                        'type' => 'Folder',
                        'path' => 'childEntity',
                        'skip' => false,
                        new SoapVar(['name' => 'FolderTraversalSpec'], SOAP_ENC_OBJECT, null, null, 'selectSet'),
                        new SoapVar(['name' => 'DataCenterVMTraversalSpec'], SOAP_ENC_OBJECT, null, null, 'selectSet'),
                    ], SOAP_ENC_OBJECT, 'TraversalSpec'),
                    new soapvar([
                        'name' => 'DataCenterVMTraversalSpec',
                        'type' => 'Datacenter',
                        'path' => 'datastoreFolder',
                        'skip' => false,
                        'selectSet' => (object) ['name' => 'FolderTraversalSpec'],
                    ], SOAP_ENC_OBJECT, 'TraversalSpec'),
                ],
            ],
        ])->returnval;
        if (!is_array($response)) {
            $response = [$response];
        }
        $datastores = [];
        foreach ($response as $ds) {
            $datastores[] = self::fromAPI($this->api, $ds);
        }

        return $datastores;
    }

    public function file(string $path): File
    {
        return new File($this->api, $this, $path);
    }

    public function getDatacenter(): Datacenter
    {
        $result = $this->api->getPropertyCollector()->_RetrieveProperties([
            'propSet' => [
                'type' => 'Datacenter',
                'all' => true,
            ],
            'objectSet' => [
                'obj' => [
                    'type' => 'Datastore',
                    '_' => $this->id,
                ],
                'skip' => false,
                'selectSet' => [
                    new SoapVar([
                        'name' => 'FolderTraversalSpec',
                        'type' => 'ManagedEntity',
                        'path' => 'parent',
                        'skip' => false,
                        new SoapVar([
                            'name' => 'FolderTraversalSpec',
                        ], SOAP_ENC_OBJECT, null, null, 'selectSet'),
                        new SoapVar(['name' => 'DataCenterVMTraversalSpec'], SOAP_ENC_OBJECT, null, null, 'selectSet'),
                    ], SOAP_ENC_OBJECT, 'TraversalSpec'),
                    new soapvar([
                        'name' => 'DataCenterVMTraversalSpec',
                        'type' => 'Datacenter',
                        'path' => 'parent',
                        'skip' => false,
                        'selectSet' => (object) ['name' => 'FolderTraversalSpec'],
                    ], SOAP_ENC_OBJECT, 'TraversalSpec'),
                ],
            ],
        ]);

        return Datacenter::fromPropertyCollector($this->api, $result->returnval);
    }

    public function browse(string $path)
    {
        $task = $this->api->getClient()->SearchDatastore_Task([
            '_this' => $this->browser,
            'datastorePath' => "[$this->name] $path",
            'searchSpec' => [
                'details' => [
                    'fileType' => true,
                    'fileSize' => true,
                    'modification' => true,
                    'fileOwner' => true,
                ],
                'sortFoldersFirst' => true,
            ],
        ])->returnval;
        $task = $this->api->getTask()->byID($task->_);
        if (!$task->waitFor(60)) {
            throw new Exception('timeout task');
        }
        if ($task->error) {
            throw new Exception($task->error->localizedMessage);
        }
        if (!isset($task->result->file)) {
            return [];
        }
        if (!is_array($task->result->file)) {
            return [$task->result->file];
        }

        return $task->result->file;
    }

    public function mkdir(string $path): void
    {
        $this->api->getClient()->MakeDirectory([
            '_this' => $this->api->getServiceContent()->fileManager,
            'name' => "[$this->name] $path",
        ]);
    }

    public function __toString()
    {
        return $this->vmfs->uuid;
    }

    public static function fromAPI(API $api, DynamicData $response, ?Datastore $datastore = null): Datastore
    {
        if (null == $datastore) {
            $datastore = new self($api);
        }

        $info = self::getPropertyByName('info', $response->propSet);

        $datastore->id = $response->obj->_;
        $datastore->browser = self::getPropertyByName('browser', $response->propSet);
        $datastore->capability = self::getPropertyByName('capability', $response->propSet);
        $datastore->host = self::getPropertyByName('host', $response->propSet);
        $datastore->info = $info;
        $datastore->name = $info->name;
        $datastore->iormConfiguration = self::getPropertyByName('iormConfiguration', $response->propSet);
        $datastore->summary = self::getPropertyByName('summary', $response->propSet);
        $datastore->configStatus = self::getPropertyByName('configStatus', $response->propSet);
        $datastore->vm = self::getPropertyByName('vm', $response->propSet);
        $datastore->vmfs = self::array2Object([
            'type' => $info->vmfs->type,
            'name' => $info->vmfs->name,
            'capacity' => $info->vmfs->capacity,
            'version' => $info->vmfs->version,
            'uuid' => $info->vmfs->uuid,
            'ssd' => $info->vmfs->ssd,
        ]);

        $datastore->setAPI($api);

        return $datastore;
    }

    public static function getPropertyByName(string $name, array $propset)
    {
        foreach ($propset as $prop) {
            if ($prop->name == $name) {
                return $prop->val;
            }
        }

        return null;
    }

    public static function array2Object(array $array): DynamicData
    {
        $new = new DynamicData();
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $value = self::array2Object($value);
            }
            $new->$key = $value;
        }

        return $new;
    }
}
