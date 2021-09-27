<?php

namespace dnj\phpvmomi\DataObjects;

/**
 * This data object type describes system information including the name, type, version, and build number.
 *
 * @todo complete
 *
 * @see https://vdc-download.vmware.com/vmwb-repository/dcr-public/b50dcbbf-051d-4204-a3e7-e1b618c1e384/538cf2ec-b34f-4bae-a332-3820ef9e7773/vim.host.Summary.html
 */
class HostListSummary extends DynamicData
{
    /**
     * @var HostListSummaryQuickStats
     */
    public $quickStats;
}
