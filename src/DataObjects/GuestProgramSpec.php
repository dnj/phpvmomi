<?php

namespace dnj\phpvmomi\DataObjects;

/**
 * @see https://vdc-download.vmware.com/vmwb-repository/dcr-public/b50dcbbf-051d-4204-a3e7-e1b618c1e384/538cf2ec-b34f-4bae-a332-3820ef9e7773/vim.vm.guest.ProcessManager.GuestProgramSpec.html
 */
class GuestProgramSpec extends DynamicData
{
    /**
     * @var string
     */
    public $arguments;

    /**
     * @var string[]|null
     */
    public $envVariables;

    /**
     * @var string
     */
    public $programPath;

    /**
     * @var string|null
     */
    public $workingDirectory;

    public function __construct(string $programPath, string $arguments, ?string $workingDirectory = null, ?array $envVariables = null)
    {
        $this->programPath = $programPath;
        $this->arguments = $arguments;
        $this->workingDirectory = $workingDirectory;
        $this->envVariables = $envVariables;
    }
}
