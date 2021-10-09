<?php

namespace dnj\phpvmomi\ManagedObjects;

use dnj\phpvmomi\DataObjects\ManagedObjectReference;

/**
 * This managed object type provides a way to manage and manipulate files and folders on datastores. The source and the destination names are in the form of a URL or a datastore path.
 * A URL has the form
 *    scheme://authority/folder/path?dcPath=dcPath&dsName=dsName
 * where
 * scheme is http or https.
 * authority specifies the hostname or IP address of the VirtualCenter or ESX server and optionally the port.
 * dcPath is the inventory path to the Datacenter containing the Datastore.
 * dsName is the name of the Datastore.
 * path is a slash-delimited path from the root of the datastore.
 * A datastore path has the form
 *     [datastore] path
 * where
 * datastore is the datastore name.
 * path is a slash-delimited path from the root of the datastore.
 * An example datastore path is "[storage] path/to/file.extension". A listing of all the files, disks and folders on a datastore can be obtained from the datastore browser.
 *
 * @todo complete methods
 *
 * @see HostDatastoreBrowser
 * @see https://vdc-download.vmware.com/vmwb-repository/dcr-public/b50dcbbf-051d-4204-a3e7-e1b618c1e384/538cf2ec-b34f-4bae-a332-3820ef9e7773/vim.FileManager.html
 */
class FileManager extends ManagedEntity
{
    use actions\FileManagerTrait;

    public function _DeleteDatastoreFile_Task(string $name, ?ManagedObjectReference $datacenter = null): Task
    {
        return $this
            ->api
            ->getClient()
            ->DeleteDatastoreFile_Task([
                '_this' => $this->ref(),
                'name' => $name,
                'datacenter' => $datacenter,
            ])
            ->returnval
            ->get($this->api);
    }

    public function _MakeDirectory(string $name, bool $createParentDirectories = false, ?ManagedObjectReference $datacenter = null): void
    {
        $this->api->getClient()->MakeDirectory([
            '_this' => $this->ref(),
            'name' => $name,
            'createParentDirectories' => $createParentDirectories,
            'datacenter' => $datacenter,
        ]);
    }

    public function _CopyDatastoreFile_Task(string $sourceName, string $destinationName, ?ManagedObjectReference $sourceDatacenter = null, ?ManagedObjectReference $destinationDatacenter = null, ?bool $force = null): Task
    {
        return $this
            ->api
            ->getClient()
            ->CopyDatastoreFile_Task([
                '_this' => $this->ref(),
                'sourceName' => $sourceName,
                'destinationName' => $destinationName,
                'sourceDatacenter' => $sourceDatacenter,
                'destinationDatacenter' => $destinationDatacenter,
                'force' => $force,
            ])
            ->returnval
            ->get($this->api);
    }
}
