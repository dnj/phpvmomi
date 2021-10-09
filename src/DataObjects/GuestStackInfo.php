<?php

namespace dnj\phpvmomi\DataObjects;

/**
 * @see https://vdc-download.vmware.com/vmwb-repository/dcr-public/b50dcbbf-051d-4204-a3e7-e1b618c1e384/538cf2ec-b34f-4bae-a332-3820ef9e7773/vim.vm.GuestInfo.StackInfo.html
 */
class GuestStackInfo extends DynamicData
{
    /**
     * @var NetDhcpConfigInfo|null
     */
    public $dhcpConfig;

    /**
     * @var NetDnsConfigInfo|null
     */
    public $dnsConfig;

    /**
     * @var NetIpRouteConfigInfo|null
     */
    public $ipRouteConfig;

    /**
     * @var KeyValue[]|null
     */
    public $ipStackConfig;
}
