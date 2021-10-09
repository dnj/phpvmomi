<?php

namespace dnj\phpvmomi\DataObjects;

/**
 * @see https://vdc-repo.vmware.com/vmwb-repository/dcr-public/6b586ed2-655c-49d9-9029-bc416323cb22/fa0b429a-a695-4c11-b7d2-2cbc284049dc/doc/vim.host.DatastoreBrowser.FileInfo.html
 */
class FileInfo extends DynamicData
{
    /**
     * @var int|null
     */
    public $fileSize;

    /**
     * @var string|null
     */
    public $friendlyName;

    /**
     * @var string|null
     */
    public $modification;

    /**
     * @var string|null
     */
    public $owner;

    /**
     * @var string
     */
    public $path;
}
