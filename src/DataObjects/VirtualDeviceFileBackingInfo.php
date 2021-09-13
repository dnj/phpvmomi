<?php
namespace dnj\phpvmomi\DataObjects;

/**
 * VirtualDeviceFileBackingInfo is a data object type for information about file backing for a device in a virtual machine. 
 * @todo recheck and complete
 * @see https://vdc-download.vmware.com/vmwb-repository/dcr-public/b50dcbbf-051d-4204-a3e7-e1b618c1e384/538cf2ec-b34f-4bae-a332-3820ef9e7773/vim.vm.device.VirtualDevice.FileBackingInfo.html
 */
class VirtualDeviceFileBackingInfo extends VirtualDeviceBackingInfo
{

	/**
	 * @var string|null Backing object's durable and unmutable identifier. Each backing object has a unique identifier which is not settable. 
	 * @since vSphere API 5.5
	 */
	public $backingObjectId;

	/**
	 * @var string Filename for the host file used in this backing.
	 */
	public $fileName;

	/**
	 * @var string Reference to the datastore managed object where this file is stored. If the file is not located on a datastore, then this reference is null. This is not used for configuration.
	 */
	public $datastore;

	public function __toString() {
		return "[{$this->datastore}] {$this->fileName}";
	}
}
