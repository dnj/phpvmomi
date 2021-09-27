<?php

namespace dnj\phpvmomi\ManagedObjects;

use dnj\phpvmomi\DataObjects\PropertyFilterSpec;

/**
 * @todo complete methoda and properties
 *
 * @see https://vdc-download.vmware.com/vmwb-repository/dcr-public/b50dcbbf-051d-4204-a3e7-e1b618c1e384/538cf2ec-b34f-4bae-a332-3820ef9e7773/vim.Datastore.html
 */
class PropertyFilter
{
    use actions\NeedAPITrait;

    /**
     * @var bool Flag to indicate if a change to a nested property reports only the nested change or the entire specified property value. If the value is true, a change reports only the nested property. If the value is false, a change reports the enclosing property named in the filter.
     */
    public $partialUpdates;

    /**
     * @var PropertyFilterSpec specifications for this filter
     */
    public $spec;
}
