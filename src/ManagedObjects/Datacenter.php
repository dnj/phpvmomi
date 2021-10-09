<?php

namespace dnj\phpvmomi\ManagedObjects;

use dnj\phpvmomi\DataObjects\ManagedObjectReference;

/**
 * @see https://vdc-download.vmware.com/vmwb-repository/dcr-public/b50dcbbf-051d-4204-a3e7-e1b618c1e384/538cf2ec-b34f-4bae-a332-3820ef9e7773/vim.Datacenter.html
 */
class Datacenter extends ManagedEntity
{
    /**
     * @var ManagedObjectReference|null
     */
    public $datastore;

    /**
     * @var ManagedObjectReference
     */
    public $datastoreFolder;

    /**
     * @var ManagedObjectReference
     */
    public $hostFolder;

    /**
     * @var ManagedObjectReference|null
     */
    public $network;

    /**
     * @var ManagedObjectReference
     */
    public $networkFolder;

    /**
     * @var ManagedObjectReference
     */
    public $vmFolder;
}
