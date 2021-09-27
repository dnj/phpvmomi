<?php

namespace dnj\phpvmomi\DataObjects;

/**
 * The FlagInfo data object type encapsulates the flag settings for a virtual machine. These properties are optional since the same structure is used to change the values during an edit or create operation.
 *
 * @todo recheck
 *
 * @see https://vdc-download.vmware.com/vmwb-repository/dcr-public/b50dcbbf-051d-4204-a3e7-e1b618c1e384/538cf2ec-b34f-4bae-a332-3820ef9e7773/vim.vm.FlagInfo.html
 */
class VirtualMachineFlagInfo extends DynamicData
{
    /**
     * @var bool|null flag to turn off video acceleration for a virtual machine console window
     */
    public $disableAcceleration;

    /**
     * @var bool|null flag to enable logging for a virtual machine
     */
    public $enableLogging;

    /**
     * @var bool|null flag to specify whether or not to use TOE (TCP/IP Offloading)
     */
    public $useToe;

    /**
     * @var bool flag to specify whether or not to run in debug mode
     *
     * @deprecated  As of VI API 2.5, use monitorType.
     */
    public $runWithDebugInfo;

    /**
     * @var string vmx process type. {@see VirtualMachineFlagInfoMonitorType} for possible values for this property.
     *
     * @since VI API 2.5
     */
    public $monitorType;

    /**
     * @var string Specifies how the VCPUs of a virtual machine are allowed to share physical cores on a hyperthreaded system. Two VCPUs are "sharing" a core if they are both running on logical CPUs of the core at the same time.
     *
     * @see VirtualMachineHtSharing
     */
    public $htSharing;

    /**
     * @var bool flag to specify whether snapshots are disabled for this virtual machine
     *
     * @deprecated As of vSphere API 4.0. The flag is ignored by the server.
     * @since VI API 2.5
     */
    public $snapshotDisabled;

    /**
     * @var bool flag to specify whether the snapshot tree is locked for this virtual machine
     *
     * @since VI API 2.5
     */
    public $snapshotLocked;

    /**
     * @var bool Indicates whether disk UUIDs are being used by this virtual machine. If this flag is set to false, disk UUIDs are not exposed to the guest.
     *           Since products before ESX 3.1 do not support disk UUIDs, moving virtual machines from a platform that supports UUID to a platform that does not support UUIDs could result in unspecified guest behavior. For virtual machines where the ability to move to older platforms is important, this flag should be set to false. If the value is unset, the behavior 'false' will be used.
     *
     * @since VI API 2.5
     */
    public $diskUuidEnabled;

    /**
     * @var string indicates whether or not the system will try to use nested page table hardware support, if available
     *
     * @since VI API 2.5
     */
    public $virtualMmuUsage;

    /**
     * @var string indicates whether or not the system will try to use Hardware Virtualization (HV) support for instruction virtualization, if available
     *
     * @since vSphere API 4.0
     * @see https://vdc-download.vmware.com/vmwb-repository/dcr-public/bd170cdc-e03a-4701-b468-bcfba05da6b2/946a76df-5276-46fa-a10d-06f0f7d4078e/doc/vim.vm.FlagInfo.html
     */
    public $virtualExecUsage;

    /**
     * @var string Specifies the power-off behavior for a virtual machine that has a snapshot. If the value is unset, the behavior 'powerOff' will be used.
     *
     * @see VirtualMachinePowerOffBehavior
     * @since VI API 2.5
     */
    public $snapshotPowerOffBehavior;

    /**
     * @var string|null Flag to specify whether record and replay operations are allowed for this virtual machine. If this flag is set to 'true', instruction virtualization will use hardware virtualization (HV) support. I.e., virtualExecUsage will be set to 'hvOn'. If this flag is set to 'false' for a virtual machine that already has a recording, replay will be disallowed, though the recording will be preserved. If the value is unset, the behavior 'false' will be used.
     *
     * @since vSphere API 4.0
     */
    public $recordReplayEnabled;
}
