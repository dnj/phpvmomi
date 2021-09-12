<?php
namespace DNJ\PHPVMOMI\DataObjects;

/**
 * @todo recheck
 * @see https://vdc-download.vmware.com/vmwb-repository/dcr-public/b50dcbbf-051d-4204-a3e7-e1b618c1e384/538cf2ec-b34f-4bae-a332-3820ef9e7773/vim.vm.device.VirtualDeviceSpec.html
 */
class VirtualDeviceConfigSpec extends DynamicData
{

	/** @var string|null The type of operation being performed on the specified virtual device. Valid values are: add, edit, remove */
	public $operation;

	/** @var string|null  The type of operation being performed on the backing of a virtual device. Valid values are: create, destroy, replace */
	public $fileOperation;

	/** @var VirtualDevice $device */
	public $device;

}
