<?php
namespace DNJ\PHPVMOMI\DataObjects;

/**
 * @todo recheck
 * @see https://vdc-download.vmware.com/vmwb-repository/dcr-public/b50dcbbf-051d-4204-a3e7-e1b618c1e384/538cf2ec-b34f-4bae-a332-3820ef9e7773/vim.vm.device.VirtualDisk.FlatVer2BackingInfo.html
 */
class VirtualDiskFlatVer2BackingInfo extends VirtualDeviceFileBackingInfo
{
	/** @var string $diskMode */
	public $diskMode;

	/** @var bool $split */
	public $split;
	
	/** @var bool $writeThrough */
	public $writeThrough;
	
	/** @var bool $thinProvisioned */
	public $thinProvisioned;
	
	/** @var bool $eagerlyScrub */
	public $eagerlyScrub;
	
	/** @var string $uuid */
	public $uuid;
	
	/** @var string $contentId */
	public $contentId;
	
	/** @var string $changeId */
	public $changeId;
	
	/** @var VirtualDiskFlatVer2BackingInfo $parent */
	public $parent;
	
	/** @var string $deltaDiskFormat */
	public $deltaDiskFormat;
	
	/** @var bool $digestEnabled */
	public $digestEnabled;

	/** @var int $deltaGrainSize */
	public $deltaGrainSize;
}
