<?php
namespace DNJ\PHPVMOMI\DataObjects;

/**
 * VirtualDeviceBackingInfo is a base data object type for information about the backing of a device in a virtual machine. This base type does not define any properties. It is used as a namespace for general-purpose subtypes. Specific devices are represented by subtypes which define properties for device-specific backing information. 
 * @todo recheck and complete
 * @see https://vdc-download.vmware.com/vmwb-repository/dcr-public/b50dcbbf-051d-4204-a3e7-e1b618c1e384/538cf2ec-b34f-4bae-a332-3820ef9e7773/vim.vm.device.VirtualDevice.BackingInfo.html
 */
class VirtualDeviceBackingInfo extends DynamicData
{

}
