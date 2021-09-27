<?php

namespace dnj\phpvmomi\DataObjects;

/**
 * @todo recheck
 *
 * @see https://vdc-download.vmware.com/vmwb-repository/dcr-public/b50dcbbf-051d-4204-a3e7-e1b618c1e384/538cf2ec-b34f-4bae-a332-3820ef9e7773/vim.vm.device.VirtualDisk.FlatVer2BackingInfo.html
 */
class VirtualDiskFlatVer2BackingInfo extends VirtualDeviceFileBackingInfo
{
    /** @var string */
    public $diskMode;

    /** @var bool */
    public $split;

    /** @var bool */
    public $writeThrough;

    /** @var bool */
    public $thinProvisioned;

    /** @var bool */
    public $eagerlyScrub;

    /** @var string */
    public $uuid;

    /** @var string */
    public $contentId;

    /** @var string */
    public $changeId;

    /** @var VirtualDiskFlatVer2BackingInfo */
    public $parent;

    /** @var string */
    public $deltaDiskFormat;

    /** @var bool */
    public $digestEnabled;

    /** @var int */
    public $deltaGrainSize;
}
