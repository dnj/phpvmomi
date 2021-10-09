<?php

namespace dnj\phpvmomi\ManagedObjects;

use dnj\phpvmomi\DataObjects\ManagedObjectReference;
use dnj\phpvmomi\DataObjects\VirtualMachineConfigSpec;

/**
 * @todo complete methods
 *
 * @see https://vdc-download.vmware.com/vmwb-repository/dcr-public/b50dcbbf-051d-4204-a3e7-e1b618c1e384/538cf2ec-b34f-4bae-a332-3820ef9e7773/vim.Folder.html
 */
class Folder extends ManagedEntity
{
    /**
     * @var ManagedEntity[] An array of managed object references. Each entry is a reference to a child entity.
     */
    public $childEntity;

    /**
     * @var string[] Specifies the object types a folder may contain. When you create a folder, it inherits its childType from the parent folder in which it is created. childType is an array of strings. Each array entry identifies a set of object types - Folder and one or more managed object types.
     */
    public $childType;

    /**
     * @var string The namespace with which the Folder is associated. Namespace is a vAPI resource which divides cluster resources and allows administrators to give Kubernetes environments to their development teams. This property is set only at the time of creation and cannot change.
     *
     * @since vSphere API 7.0
     */
    public $namespace;

    public function _CreateVM_Task(VirtualMachineConfigSpec $config, ManagedObjectReference $pool, ?ManagedObjectReference $host = null): Task
    {
        return $this->api
            ->getClient()
            ->CreateVM_Task([
                '_this' => $this->ref(),
                'config' => $config,
                'pool' => $pool,
                'host' => $host,
            ])
            ->returnval
            ->get($this->api);
    }

    public function _RegisterVM_Task(string $path, bool $asTemplate, ?string $name = null, ?ManagedObjectReference $pool = null, ?ManagedObjectReference $host = null): Task
    {
        return $this->api
            ->getClient()
            ->RegisterVM_Task([
                '_this' => $this->ref(),
                'path' => $path,
                'asTemplate' => $asTemplate,
                'name' => $name,
                'pool' => $pool,
                'host' => $host,
            ])
            ->returnval
            ->get($this->api);
    }
}
