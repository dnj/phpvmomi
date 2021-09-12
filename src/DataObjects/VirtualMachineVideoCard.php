<?php
namespace DNJ\PHPVMOMI\DataObjects;

/**
 * @todo recheck
 * @see https://vdc-download.vmware.com/vmwb-repository/dcr-public/b50dcbbf-051d-4204-a3e7-e1b618c1e384/538cf2ec-b34f-4bae-a332-3820ef9e7773/vim.vm.device.VirtualVideoCard.html
 */
class VirtualMachineVideoCard extends VirtualDevice
{
	/** @var int $videoRamSizeInKB */
	public $videoRamSizeInKB;

	/** @var int $numDisplays */
	public $numDisplays;

	/** @var bool $useAutoDetect */
	public $useAutoDetect;

	/** @var bool $enable3DSupport */
	public $enable3DSupport;

	/** @var string $use3DRenderer */
	public $use3DRenderer;
}
