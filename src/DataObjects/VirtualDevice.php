<?php

namespace dnj\phpvmomi\DataObjects;

/**
 * VirtualDevice is the base data object type for devices in a virtual machine. This type contains enough information about a virtual device to allow clients to display devices they do not recognize. For example, a client with an older version than the server to which it connects may see a device without knowing what it is.
 *
 * @see https://vdc-download.vmware.com/vmwb-repository/dcr-public/b50dcbbf-051d-4204-a3e7-e1b618c1e384/538cf2ec-b34f-4bae-a332-3820ef9e7773/vim.vm.device.VirtualDevice.html
 */
class VirtualDevice extends DynamicData
{
    /**
     * @var int This property is a unique key that distinguishes this device from other devices in the same virtual machine. Keys are immutable but may be recycled; that is, a key does not change as long as the device is associated with a particular virtual machine. However, once a device is removed, its key may be used when another device is added.
     *          This property is not read-only, but the client cannot control its value. Persistent device keys are always assigned and managed by the server, which guarantees that all devices will have non-negative key values.
     */
    public $key;

    /**
     * @var Description|null provides a label and summary information for the device
     */
    public $deviceInfo;

    /**
     * @var VirtualDeviceBackingInfo|null Information about the backing of this virtual device presented in the context of the virtual machine's environment. Not all devices are required to have backing information.
     *
     * @see VirtualMachineConfigOption
     */
    public $backing;

    /**
     * @var VirtualDeviceConnectInfo|null Information about restrictions on removing this device while a virtual machine is running. If the device is not removable, then this property is null.
     */
    public $connectable;

    /**
     * @todo type is VirtualDeviceBusSlotInfo
     *
     * @var DynamicData information about the bus slot of a device in a virtual machine
     *
     * @since vSphere API 5.1
     */
    public $slotInfo;

    /**
     * @var int Object key that denotes the controller object for this device. This property contains the key property value of the controller device object.
     */
    public $controllerKey;

    /**
     * @var int Unit number of this device on its controller. This property is null if the controller property is null (for example, when the device is not attached to a specific controller object).
     *          Normally, two devices on the same controller may not be assigned the same unit number.
     */
    public $unitNumber;
}
