<?php

namespace dnj\phpvmomi\DataObjects;

/**
 * @see https://vdc-repo.vmware.com/vmwb-repository/dcr-public/6b586ed2-655c-49d9-9029-bc416323cb22/fa0b429a-a695-4c11-b7d2-2cbc284049dc/doc/vim.host.DatastoreBrowser.SearchSpec.html
 */
class HostDatastoreBrowserSearchSpec extends DynamicData
{
    /**
     * @var FileQueryFlags|null
     */
    public $details;

    /**
     * @var string[]|null
     */
    public $matchPattern;

    /**
     * @var FileQuery[]|null
     */
    public $query;

    /**
     * @var bool|null
     */
    public $searchCaseInsensitive;

    /**
     * @var bool|null
     */
    public $sortFoldersFirst;
}
