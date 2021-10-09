<?php

namespace dnj\phpvmomi\ManagedObjects;

use dnj\phpvmomi\DataObjects\FileQuery;
use dnj\phpvmomi\DataObjects\HostDatastoreBrowserSearchSpec;
use dnj\phpvmomi\DataObjects\ManagedObjectReference;

/**
 * @see https://vdc-repo.vmware.com/vmwb-repository/dcr-public/6b586ed2-655c-49d9-9029-bc416323cb22/fa0b429a-a695-4c11-b7d2-2cbc284049dc/doc/vim.host.DatastoreBrowser.html
 */
class HostDatastoreBrowser extends ManagedEntity
{
    use actions\HostDatastoreBrowserTrait;

    /**
     * @var ManagedObjectReference[]|null
     */
    public $datastore;

    /**
     * @var FileQuery[]|null
     */
    public $supportedType;

    public function _SearchDatastore_Task(string $datastorePath, ?HostDatastoreBrowserSearchSpec $searchSpec = null)
    {
        return $this->api->getClient()->SearchDatastore_Task([
            '_this' => $this->ref(),
            'datastorePath' => $datastorePath,
            'searchSpec' => $searchSpec,
        ])->returnval->get($this->api);
    }
}
