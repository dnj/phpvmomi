<?php

namespace dnj\phpvmomi\DataObjects;

/**
 * @todo recheck
 *
 * @see https://vdc-download.vmware.com/vmwb-repository/dcr-public/b50dcbbf-051d-4204-a3e7-e1b618c1e384/538cf2ec-b34f-4bae-a332-3820ef9e7773/vim.vm.device.VirtualVideoCard.html
 */
class VirtualMachineVideoCard extends VirtualDevice
{
    /** @var int */
    public $videoRamSizeInKB;

    /** @var int */
    public $numDisplays;

    /** @var bool */
    public $useAutoDetect;

    /** @var bool */
    public $enable3DSupport;

    /** @var string */
    public $use3DRenderer;
}
