<?php

namespace dnj\phpvmomi\ManagedObjects;

/**
 * @see https://vdc-download.vmware.com/vmwb-repository/dcr-public/b50dcbbf-051d-4204-a3e7-e1b618c1e384/538cf2ec-b34f-4bae-a332-3820ef9e7773/vim.HostSystem.html
 */
class HostSystem extends ManagedEntity
{
    use actions\NeedAPITrait;
    use actions\HostSystemTrait;
    public const TYPE = 'HostSystem';

    /**
     * @var AnswerFileStatusResult
     */
    public $answerFileValidationResult;

    /**
     * @var AnswerFileStatusResult
     */
    public $answerFileValidationState;

    /**
     * @var HostCapability
     */
    public $capability;

    /**
     * @var ComplianceResult
     */
    public $complianceCheckResult;

    /**
     * @var HostSystemComplianceCheckState
     */
    public $complianceCheckState;

    /**
     * @var HostConfigInfo
     */
    public $config;

    /**
     * 	@var HostConfigManager
     */
    public $configManager;

    /**
     * @var Datastore[]
     */
    public $datastore;

    /**
     * @var HostDatastoreBrowser
     */
    public $datastoreBrowser;

    /**
     * @var HostHardwareInfo
     */
    public $hardware;

    /**
     * @var HostLicensableResourceInfo
     */
    public $licensableResource;

    /**
     * @var Network[]
     */
    public $network;

    /**
     * @var ApplyHostProfileConfigurationSpec
     */
    public $precheckRemediationResult;

    /**
     * @var ApplyHostProfileConfigurationResult $remediationResult
     */
    public $remediationResult;

    /**
     * @var HostSystemRemediationState
     */
    public $remediationState;

    /**
     * @var HostRuntimeInfo
     */
    public $runtime;

    /**
     * @var HostListSummary
     */
    public $summary;

    /**
     * @var HostSystemResourceInfo
     */
    public $systemResources;

    /**
     * @var VirtualMachine[]
     */
    public $vm;
}
