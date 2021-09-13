<?php
namespace dnj\phpvmomi\DataObjects;

/**
 * @todo recheck
 * @see https://vdc-download.vmware.com/vmwb-repository/dcr-public/b50dcbbf-051d-4204-a3e7-e1b618c1e384/538cf2ec-b34f-4bae-a332-3820ef9e7773/vim.vm.ToolsConfigInfo.html
 */
class ToolsConfigInfo extends DynamicData
{
	
	/** @var int $toolsVersion */
	public $toolsVersion;

	/** @var bool $afterPowerOn */
	public $afterPowerOn;

	/** @var bool $afterResume */
	public $afterResume;

	/** @var bool $beforeGuestStandby */
	public $beforeGuestStandby;

	/** @var bool $beforeGuestShutdown */
	public $beforeGuestShutdown;

	/** @var bool $beforeGuestReboot */
	public $beforeGuestReboot;
	
	/** @var string $toolsUpgradePolicy */
	public $toolsUpgradePolicy;
	
	/** @var string $pendingCustomization */
	public $pendingCustomization;
	
	/** @var string $syncTimeWithHost */
	public $syncTimeWithHost;
	
	/** @var ToolsConfigInfoToolsLastInstallInfo $lastInstallInfo */
	public $lastInstallInfo;
}