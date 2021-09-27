<?php

namespace dnj\phpvmomi\DataObjects;

/**
 * The CpuIdInfo data object type is used to represent the CPU features of a particular host or product, or to specify what the CPU feature requirements are for a particular virtual machine or guest operating system.
 *
 * @see https://vdc-download.vmware.com/vmwb-repository/dcr-public/b50dcbbf-051d-4204-a3e7-e1b618c1e384/538cf2ec-b34f-4bae-a332-3820ef9e7773/vim.host.CpuIdInfo.html
 */
class HostCpuIdInfo extends DynamicData
{
    /**
     * @var string string representing the required EAX bits
     */
    public $eax;

    /**
     * @var string string representing the required EBX bits
     */
    public $ebx;

    /**
     * @var string string representing the required ECX bits
     */
    public $ecx;

    /**
     * @var string string representing the required EDX bits
     */
    public $edx;

    /**
     * @var int level (EAX input to CPUID)
     */
    public $level;

    /**
     * @var string used if this mask is for a particular vendor
     */
    public $vendor;
}
