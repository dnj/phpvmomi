<?php

namespace dnj\phpvmomi\DataObjects;

/**
 * @see https://vdc-download.vmware.com/vmwb-repository/dcr-public/b50dcbbf-051d-4204-a3e7-e1b618c1e384/538cf2ec-b34f-4bae-a332-3820ef9e7773/vmodl.query.PropertyCollector.FilterSpec.html
 */
class PropertyFilterSpec extends DynamicData
{
    /**
     * @var ObjectSpec[]
     */
    public $objectSet;

    /**
     * @var PropertySpec[]
     */
    public $propSet;

    /**
     * @var bool|null
     */
    public $reportMissingObjectsInResults;

    /**
     * @param ObjectSpec[]   $objectSet
     * @param PropertySpec[] $propSet
     */
    public function __construct(array $objectSet, array $propSet)
    {
        $this->objectSet = $objectSet;
        $this->propSet = $propSet;
    }
}
