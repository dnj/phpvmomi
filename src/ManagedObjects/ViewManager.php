<?php

namespace dnj\phpvmomi\ManagedObjects;

use dnj\phpvmomi\DataObjects\ManagedObjectReference;

/**
 * @todo implement
 *
 * @see https://vdc-download.vmware.com/vmwb-repository/dcr-public/b50dcbbf-051d-4204-a3e7-e1b618c1e384/538cf2ec-b34f-4bae-a332-3820ef9e7773/vim.view.ViewManager.html
 */
class ViewManager extends ManagedEntity
{
    /**
     * @var ManagedObjectReference[]|null
     */
    public $viewList;

    /**
     * @param string[] $type
     */
    public function _CreateContainerView(ManagedObjectReference $container, array $type, bool $recursive = true): ManagedObjectReference
    {
        return $this->api->getClient()->CreateContainerView([
            '_this' => $this->ref(),
            'container' => $container,
            'type' => $type,
            'recursive' => $recursive,
        ])->returnval;
    }
}
