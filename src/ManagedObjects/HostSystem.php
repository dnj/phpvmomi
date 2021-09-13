<?php
namespace dnj\phpvmomi\ManagedObjects;

use dnj\phpvmomi\API;
use dnj\phpvmomi\DataObjects\Event;

/**
 * @see https://vdc-download.vmware.com/vmwb-repository/dcr-public/b50dcbbf-051d-4204-a3e7-e1b618c1e384/538cf2ec-b34f-4bae-a332-3820ef9e7773/vim.HostSystem.html
 */
class HostSystem extends ManagedEntity
{
	use actions\NeedAPITrait,
		actions\HostSystemTrait;

	/**
	 * @var AnswerFileStatusResult $answerFileValidationResult
	 */
	public $answerFileValidationResult;

	/**
	 * @var AnswerFileStatusResult $answerFileValidationState
	 */
	public $answerFileValidationState;

	/**
	 * @var HostCapability $answerFileValidationState
	 */
	public $capability;

	/**
	 * @var ComplianceResult $complianceCheckResult
	 */
	public $complianceCheckResult;

	/**
	 * @var HostSystemComplianceCheckState $complianceCheckState
	 */
	public $complianceCheckState;

	/**
	 * @var HostConfigInfo $config
	 */
	public $config;

	/**
	 * 	@var HostConfigManager $configManager
	 */
	public $configManager;

	/**
	 * @var Datastore[] $datastore
	 */
	public $datastore;

	/**
	 * @var HostDatastoreBrowser $datastoreBrowser
	 */
	public $datastoreBrowser;

	/**
	 * @var HostHardwareInfo $hardware
	 */
	public $hardware;

	/**
	 * @var HostLicensableResourceInfo $licensableResource
	 */
	public $licensableResource;

	/**
	 * @var Network[] $network
	 */
	public $network;

	/**
	 * @var ApplyHostProfileConfigurationSpec $precheckRemediationResult
	 */
	public $precheckRemediationResult;

	/**
	 * @var ApplyHostProfileConfigurationResult	$remediationResult
	 */
	public $remediationResult;

	/**
	 * @var HostSystemRemediationState $remediationState
	 */
	public $remediationState;

	/**
	 * @var HostRuntimeInfo $runtime
	 */
	public $runtime;

	/**
	 * @var HostListSummary $summary
	 */
	public $summary;

	/**
	 * @var HostSystemResourceInfo $systemResources
	 */
	public $systemResources;

	/**
	 * @var VirtualMachine[] $vm
	 */
	public $vm;
}
