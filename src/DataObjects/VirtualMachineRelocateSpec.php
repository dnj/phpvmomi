<?php

namespace dnj\phpvmomi\DataObjects;

/**
 * @todo add cryptoSpec property
 * @todo add disk property
 * @todo add diskMoveType property
 * @todo add profile property
 * @todo add service property
 * @todo add transform property
 *
 * @see https://vdc-download.vmware.com/vmwb-repository/dcr-public/b50dcbbf-051d-4204-a3e7-e1b618c1e384/538cf2ec-b34f-4bae-a332-3820ef9e7773/vim.vm.RelocateSpec.html
 */
class VirtualMachineRelocateSpec extends DynamicData
{
    /**
     * ManagedObjectReference to a Datastore.
     *
     * @var ManagedObjectReference|null The datastore where the virtual machine should be located. If not specified, the current datastore is used.
     */
    public $datastore;

    /**
     * ManagedObjectReference to a Folder.
     *
     * @var ManagedObjectReference|null The folder where the virtual machine should be located. If not specified, the root VM folder of the destination datacenter will be used.
     */
    public $folder;

    /**
     * ManagedObjectReference to a Host.
     *
     * @var ManagedObjectReference|null The target host for the virtual machine
     */
    public $host;

    /**
     * ManagedObjectReference to a ResourcePool.
     *
     * @var ManagedObjectReference|null the resource pool to which this virtual machine should be attached
     */
    public $pool;
}
