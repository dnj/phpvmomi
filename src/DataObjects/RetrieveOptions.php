<?php

namespace dnj\phpvmomi\DataObjects;

/**
 * @see https://vdc-download.vmware.com/vmwb-repository/dcr-public/fe08899f-1eec-4d8d-b3bc-a6664c168c2c/7fdf97a1-4c0d-4be0-9d43-2ceebbc174d9/doc/vmodl.query.PropertyCollector.RetrieveResult.html
 */
class RetrieveOptions extends DynamicData
{
    public ?int $maxObjects = null;

    public function __construct(?int $maxObjects = null)
    {
        $this->maxObjects = $maxObjects;
    }
}
