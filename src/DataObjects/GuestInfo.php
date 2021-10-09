<?php

namespace dnj\phpvmomi\DataObjects;

/**
 * @see https://vdc-download.vmware.com/vmwb-repository/dcr-public/b50dcbbf-051d-4204-a3e7-e1b618c1e384/538cf2ec-b34f-4bae-a332-3820ef9e7773/vim.VirtualMachine.html
 */
class GuestInfo extends DynamicData
{
    /**
     * @var string|null
     */
    public $appHeartbeatStatus;

    /**
     * @var string|null
     */
    public $appState;

    /**
     * @var GuestDiskInfo[]|null
     */
    public $disk;

    /**
     * @var GuestInfoNamespaceGenerationInfo[]|null
     */
    public $generationInfo;

    /**
     * @var string|null
     */
    public $guestFamily;

    /**
     * @var string|null
     */
    public $guestFullName;

    /**
     * @var string|null
     */
    public $guestId;

    /**
     * @var bool|null
     */
    public $guestKernelCrashed;

    /**
     * @var bool|null
     */
    public $guestOperationsReady;

    /**
     * @var string
     */
    public $guestState;

    /**
     * @var bool|null
     */
    public $guestStateChangeSupported;

    /**
     * @var string|null
     */
    public $hostName;

    /**
     * @var string|null
     */
    public $hwVersion;

    /**
     * @var bool|null
     */
    public $interactiveGuestOperationsReady;

    /**
     * @var string|null
     */
    public $ipAddress;

    /**
     * @var GuestStackInfo|null
     */
    public $ipStack;

    /**
     * @var GuestNicInfo[]|null
     */
    public $net;

    /**
     * @var GuestScreenInfo|null
     */
    public $screen;

    /**
     * @var string|null
     */
    public $toolsInstallType;

    /**
     * @var string|null
     */
    public $toolsRunningStatus;

    /**
     * @var string|null
     */
    public $toolsStatus;

    /**
     * @var string|null
     */
    public $toolsVersion;

    /**
     * @var string|null
     */
    public $toolsVersionStatus;

    /**
     * @var string|null
     */
    public $toolsVersionStatus2;
}
