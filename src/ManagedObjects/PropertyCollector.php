<?php

namespace dnj\phpvmomi\ManagedObjects;

use dnj\phpvmomi\DataObjects\ManagedObjectReference;
use dnj\phpvmomi\DataObjects\ObjectContent;
use dnj\phpvmomi\DataObjects\PropertyFilterSpec;
use dnj\phpvmomi\DataObjects\RetrieveOptions;
use dnj\phpvmomi\DataObjects\RetrieveResult;

/**
 * @todo complete methoda and properties
 *
 * @see https://vdc-download.vmware.com/vmwb-repository/dcr-public/b50dcbbf-051d-4204-a3e7-e1b618c1e384/538cf2ec-b34f-4bae-a332-3820ef9e7773/vim.Datastore.html
 */
class PropertyCollector extends ManagedEntity
{
    use actions\PropertyCollectorTrait;

    /**
     * @var ManagedObjectReference[]
     */
    public $filter;

    /**
     * @return ObjectContent[]|null
     */
    public function _RetrieveProperties($specSet): array
    {
        $result = $this->api->getClient()->RetrieveProperties([
            '_this' => $this->ref(),
            'specSet' => $specSet,
        ])->returnval ?? [];
        if (!is_array($result)) {
            $result = [$result];
        }

        return $result;
    }

    /**
     * @param PropertyFilterSpec[] $specSet
     */
    public function _RetrievePropertiesEx(array $specSet, ?RetrieveOptions $options = null): ?RetrieveResult
    {
        $options = $options ?? new RetrieveOptions();

        return $this->api->getClient()->RetrievePropertiesEx([
            '_this' => $this->ref(),
            'specSet' => $specSet,
            'options' => $options,
        ])->returnval ?? null;
    }

    public function _ContinueRetrievePropertiesEx(string $token): ?RetrieveResult
    {
        return $this->api->getClient()->ContinueRetrievePropertiesEx([
            '_this' => $this->ref(),
            'token' => $token,
        ])->returnval ?? null;
    }
}
