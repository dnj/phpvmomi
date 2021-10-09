<?php

namespace dnj\phpvmomi\DataObjects;

/**
 * @todo add customization property
 * @todo add snapshot property
 *
 * @see https://vdc-download.vmware.com/vmwb-repository/dcr-public/b50dcbbf-051d-4204-a3e7-e1b618c1e384/538cf2ec-b34f-4bae-a332-3820ef9e7773/vim.vm.CloneSpec.html
 */
class VirtualMachineCloneSpec extends DynamicData
{
    /**
     * @var VirtualMachineConfigSpec|null An optional specification of changes to the virtual hardware. For example, this can be used to, (but not limited to) reconfigure the networks the virtual switches are hooked up to in the cloned virtual machine. Use deviceChange in location for specifying any virtual device changes for disks and networks.
     */
    public $config;

    /**
     * @var VirtualMachineRelocateSpec|null a type of RelocateSpec that specifies the location of resources the newly cloned virtual machine will use
     */
    public $location;

    /**
     * Flag indicating whether to retain a copy of the source virtual machine's memory state in the clone. Retaining the memory state during clone results in a clone in suspended state with all network adapters removed to avoid network conflicts, except those with a VirtualEthernetCard.addressType of "manual". Users of this flag should take special care so that, when adding a network adapter back to the clone, the VM is not resumed on the same VM network as the source VM, or else MAC address conflicts could occur. When cloning between two hosts with different CPUs outside an EVC cluster, users of this flag should be aware that vCenter does not verify CPU compatibility between the clone's memory state and the target host prior to the clone operation, so the clone may fail to resume until it is migrated to a host with a compatible CPU.
     * This flag is ignored if the snapshot parameter is unset. This flag only applies for a snapshot taken on a running or suspended virtual machine with the 'memory' parameter set to true, because otherwise the snapshot has no memory state. This flag defaults to false.
     *
     * @var bool
     */
    public $memory;

    /**
     * @var bool Specifies whether or not the new VirtualMachine should be powered on after creation. As part of a customization, this flag is normally set to true, since the first power-on operation completes the customization process. This flag is ignored if a template is being created.
     */
    public $powerOn;

    /**
     * @var bool specifies whether or not the new virtual machine should be marked as a template
     */
    public $template;
}
