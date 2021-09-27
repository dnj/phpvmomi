<?php

namespace dnj\phpvmomi\DataObjects;

/**
 * @todo recheck
 *
 * @see https://vdc-download.vmware.com/vmwb-repository/dcr-public/b50dcbbf-051d-4204-a3e7-e1b618c1e384/538cf2ec-b34f-4bae-a332-3820ef9e7773/vim.vm.ToolsConfigInfo.html
 */
class ToolsConfigInfo extends DynamicData
{
    /** @var int */
    public $toolsVersion;

    /** @var bool */
    public $afterPowerOn;

    /** @var bool */
    public $afterResume;

    /** @var bool */
    public $beforeGuestStandby;

    /** @var bool */
    public $beforeGuestShutdown;

    /** @var bool */
    public $beforeGuestReboot;

    /** @var string */
    public $toolsUpgradePolicy;

    /** @var string */
    public $pendingCustomization;

    /** @var string */
    public $syncTimeWithHost;

    /** @var ToolsConfigInfoToolsLastInstallInfo */
    public $lastInstallInfo;
}
