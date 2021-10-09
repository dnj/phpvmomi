<?php

namespace dnj\phpvmomi\ManagedObjects;

use dnj\phpvmomi\DataObjects\ManagedObjectReference;

/**
 * @see https://vdc-download.vmware.com/vmwb-repository/dcr-public/b50dcbbf-051d-4204-a3e7-e1b618c1e384/538cf2ec-b34f-4bae-a332-3820ef9e7773/vim.vm.guest.GuestOperationsManager.html
 */
class GuestOperationsManager extends ManagedEntity
{
    /**
     * @var ManagedObjectReference|null
     */
    public $aliasManager;

    /**
     * @var ManagedObjectReference|null
     */
    public $authManager;

    /**
     * @var ManagedObjectReference|null
     */
    public $fileManager;

    /**
     * @var ManagedObjectReference|null
     */
    public $guestWindowsRegistryManager;

    /**
     * @var ManagedObjectReference|null
     */
    public $processManager;
}
