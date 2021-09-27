<?php

namespace dnj\phpvmomi\DataObjects;

/**
 * This data object type describes system information including the name, type, version, and build number.
 *
 * @see https://vdc-download.vmware.com/vmwb-repository/dcr-public/b50dcbbf-051d-4204-a3e7-e1b618c1e384/538cf2ec-b34f-4bae-a332-3820ef9e7773/vim.vm.device.VirtualEthernetCard.ResourceAllocation.html
 */
class VirtualEthernetCardResourceAllocation extends DynamicData
{
    /**
     * @var int The bandwidth limit for the virtual network adapter. The utilization of the virtual network adapter will not exceed this limit, even if there are available resources. To clear the value of this property and revert it to unset, set the vaule to "-1" in an update operation. Units in Mbits/sec.
     */
    public $limit;

    /**
     * @var int Amount of network bandwidth that is guaranteed to the virtual network adapter. If utilization is less than reservation, the resource can be used by other virtual network adapters. Reservation is not allowed to exceed the value of limit if limit is set. Units in Mbits/sec.
     */
    public $reservation;

    /**
     * @var SharesInfo Network share. The value is used as a relative weight in competing for shared bandwidth, in case of resource contention.
     */
    public $share;
}
