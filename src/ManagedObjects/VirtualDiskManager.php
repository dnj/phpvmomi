<?php

namespace dnj\phpvmomi\ManagedObjects;

use dnj\phpvmomi\DataObjects\ManagedObjectReference;
use dnj\phpvmomi\DataObjects\VirtualDiskSpec;

/**
 * @see https://vdc-download.vmware.com/vmwb-repository/dcr-public/b50dcbbf-051d-4204-a3e7-e1b618c1e384/538cf2ec-b34f-4bae-a332-3820ef9e7773/vim.VirtualDiskManager.html#copyVirtualDisk
 */
class VirtualDiskManager extends ManagedEntity
{
    public function _CopyVirtualDisk_Task(string $sourceName, string $destName, ?ManagedObjectReference $sourceDatacenter = null, ?ManagedObjectReference $destDatacenter = null, ?VirtualDiskSpec $destSpec = null, ?bool $force = null): Task
    {
        return $this
            ->api
            ->getClient()
            ->CopyVirtualDisk_Task([
                '_this' => $this->ref(),
                'sourceName' => $sourceName,
                'destName' => $destName,
                'sourceDatacenter' => $sourceDatacenter,
                'destDatacenter' => $destDatacenter,
                'destSpec' => $destSpec,
                'force' => $force,
            ])
            ->returnval
            ->get($this->api);
    }
}
