<?php
namespace DNJ\PHPVMOMI\DataObjects;

/**
 * The FileInfo data object type contains the locations of virtual machine files other than the virtual disk files. The configurable parameters are all in the FileInfo object. 
 * The object also contains a FileLayout object that returns a complete list of additional files that makes up the virtual machine configuration. This is a read-only structure and is returned when the configuration is read. This is ignored during configuration and can be left out. 
 * @todo recheck and complete
 * @see https://vdc-download.vmware.com/vmwb-repository/dcr-public/b50dcbbf-051d-4204-a3e7-e1b618c1e384/538cf2ec-b34f-4bae-a332-3820ef9e7773/vim.vm.FileInfo.html
 */
class VirtualMachineFileInfo extends DynamicData
{

	/**
	 * @var srting|null Path name to the configuration file for the virtual machine, e.g., the .vmx file. This also implicitly defines the configuration directory.
	 */
	public $vmPathName;

	/**
	 * @var srting|null Path name of the directory that typically holds suspend, redo, or snapshot files belonging to the virtual machine. This path name defaults to the same directory as the configuration file.
	 * 				ESX Server requires this to indicate a VMFS volume or NAS volume (for ESX Server 3). In case the configuration file is not stored on VMFS or NAS, this property must be set explicitly.
	 */
	public $snapshotDirectory;

	/**
	 * @var srting|null Some products allow the suspend directory to be different than the snapshot directory. On products where this is not possible, setting of this property is ignored.
	 */
	public $suspendDirectory;

	/**
	 * @var srting|null Directory to store the log files for the virtual machine. If not specified, this defaults to the same directory as the configuration file.
	 */
	public $logDirectory;
}
