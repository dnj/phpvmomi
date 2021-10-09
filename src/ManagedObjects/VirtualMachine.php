<?php

namespace dnj\phpvmomi\ManagedObjects;

use dnj\phpvmomi\DataObjects\DynamicData;
use dnj\phpvmomi\DataObjects\GuestInfo;
use dnj\phpvmomi\DataObjects\ManagedObjectReference;
use dnj\phpvmomi\DataObjects\VirtualMachineCloneSpec;
use dnj\phpvmomi\DataObjects\VirtualMachineConfigSpec;
use dnj\phpvmomi\DataObjects\VirtualMachineRuntimeInfo;
use dnj\phpvmomi\DataObjects\VirtualMachineSummary;

/**
 * @todo complete
 *
 * @see https://vdc-download.vmware.com/vmwb-repository/dcr-public/b50dcbbf-051d-4204-a3e7-e1b618c1e384/538cf2ec-b34f-4bae-a332-3820ef9e7773/vim.VirtualMachine.html
 */
class VirtualMachine extends ManagedEntity
{
    use actions\VirtualMachineTrait;

    /**
     * @var VirtualMachineRuntimeInfo
     */
    public $runtime;

    /**
     * @var DynamicData
     */
    public $config;

    /**
     * @var GuestInfo|null
     */
    public $guest;

    /**
     * @var VirtualMachineSummary
     */
    public $summary;

    /**
     * @var ManagedObjectReference
     */
    public $parent;

    /**
     * @var ManagedObjectReference[]|null
     */
    public $datastore;

    /**
     * @var ManagedObjectReference|null
     */
    public $resourcePool;

    /**
     * @todo Move to right place
     */
    public const on = 1;
    public const off = 2;
    public const suspend = 3;
    public const running = 1;

    public const vmxnet3 = 'VirtualVmxnet3';
    public const e1000 = 'VirtualE1000';

    public function _PowerOnVM_Task(): Task
    {
        return $this->api->getClient()->PowerOnVM_Task([
            '_this' => $this->ref(),
        ])->returnval->get($this->api);
    }

    public function _PowerOffVM_Task(): Task
    {
        return $this->api->getClient()->PowerOffVM_Task([
            '_this' => $this->ref(),
        ])->returnval->get($this->api);
    }

    public function _ResetVM_Task(): Task
    {
        return $this->api->getClient()->ResetVM_Task([
            '_this' => $this->ref(),
        ])->returnval->get($this->api);
    }

    public function _SuspendVM_Task(): Task
    {
        return $this->api->getClient()->SuspendVM_Task([
            '_this' => $this->ref(),
        ])->returnval->get($this->api);
    }

    public function _RebootGuest(): Task
    {
        return $this->api->getClient()->RebootGuest([
            '_this' => $this->ref(),
        ])->returnval->get($this->api);
    }

    public function _ShutdownGuest(): Task
    {
        return $this->api->getClient()->ShutdownGuest([
            '_this' => $this->ref(),
        ])->returnval->get($this->api);
    }

    public function _UnregisterVM(): Task
    {
        return $this->api->getClient()->UnregisterVM([
            '_this' => $this->ref(),
        ])->returnval->get($this->api);
    }

    public function _ReconfigVM_Task(VirtualMachineConfigSpec $spec): Task
    {
        return $this->api->getClient()->ReconfigVM_Task([
            '_this' => $this->ref(),
            'spec' => $spec,
        ])->returnval->get($this->api);
    }

    public function _CloneVM_Task(string $name, ManagedObjectReference $folder, VirtualMachineCloneSpec $spec): Task
    {
        return $this->api->getClient()->CloneVM_Task([
            '_this' => $this->ref(),
            'name' => $name,
            'folder' => $folder,
            'spec' => $spec,
        ])->returnval->get($this->api);
    }
}
