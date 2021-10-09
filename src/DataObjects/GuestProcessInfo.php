<?php

namespace dnj\phpvmomi\DataObjects;

/**
 * @see https://vdc-download.vmware.com/vmwb-repository/dcr-public/b50dcbbf-051d-4204-a3e7-e1b618c1e384/538cf2ec-b34f-4bae-a332-3820ef9e7773/vim.vm.guest.ProcessManager.ProcessInfo.html
 */
class GuestProcessInfo extends DynamicData
{
    /**
     * @var string
     */
    public $cmdLine;

    /**
     * @var string|null
     */
    public $endTime;

    /**
     * @var int|null
     */
    public $exitCode;

    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $owner;

    /**
     * @var int
     */
    public $pid;

    /**
     * @var string
     */
    public $startTime;
}
