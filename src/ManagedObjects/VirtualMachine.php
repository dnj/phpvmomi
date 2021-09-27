<?php

namespace dnj\phpvmomi\ManagedObjects;

use dnj\phpvmomi\DataObjects\DynamicData;
use dnj\phpvmomi\DataObjects\VirtualMachineConfigSpec;
use dnj\phpvmomi\DataObjects\VirtualMachineRuntimeInfo;
use dnj\phpvmomi\DataObjects\VirtualMachineSummary;
use dnj\phpvmomi\Exceptions\BadCallMethod;

/**
 * @todo complete
 *
 * @see https://vdc-download.vmware.com/vmwb-repository/dcr-public/b50dcbbf-051d-4204-a3e7-e1b618c1e384/538cf2ec-b34f-4bae-a332-3820ef9e7773/vim.VirtualMachine.html
 */
class VirtualMachine extends ManagedEntity
{
    use actions\NeedAPITrait;
    use actions\VirtualMachineTrait;

    public const TYPE = 'VirtualMachine';

    /**
     * @var VirtualMachineRuntimeInfo
     */
    public $runtime;

    /**
     * @var DynamicData
     */
    public $config;

    /**
     * @var VirtualMachineSummary
     */
    public $summary;

    /**
     * @todo Move to right place
     */
    public const on = 1;
    public const off = 2;
    public const suspend = 3;
    public const running = 1;

    public const vmxnet3 = 'VirtualVmxnet3';
    public const e1000 = 'VirtualE1000';

    public function _PowerOnVM_Task(): Task
    {
        if (empty($this->id)) {
            throw new BadCallMethod('Can not call method: '.__CLASS__.'@'.__FUNCTION__.'! ID is not setted!');
        }
        $response = $this->api->getClient()->PowerOnVM_Task([
            '_this' => [
                '_' => $this->id,
                'type' => self::TYPE,
            ],
        ]);

        return $this->api->getTask()->byID($response->returnval->_);
    }

    public function _PowerOffVM_Task(): Task
    {
        if (empty($this->id)) {
            throw new BadCallMethod('Can not call method: '.__CLASS__.'@'.__FUNCTION__.'! ID is not setted!');
        }
        $response = $this->api->getClient()->PowerOffVM_Task([
            '_this' => [
                '_' => $this->id,
                'type' => self::TYPE,
            ],
        ]);

        return $this->api->getTask()->byID($response->returnval->_);
    }

    public function _ResetVM_Task(): Task
    {
        if (empty($this->id)) {
            throw new BadCallMethod('Can not call method: '.__CLASS__.'@'.__FUNCTION__.'! ID is not setted!');
        }
        $response = $this->api->getClient()->ResetVM_Task([
            '_this' => [
                '_' => $this->id,
                'type' => self::TYPE,
            ],
        ]);

        return $this->api->getTask()->byID($response->returnval->_);
    }

    public function _SuspendVM_Task(): Task
    {
        if (empty($this->id)) {
            throw new BadCallMethod('Can not call method: '.__CLASS__.'@'.__FUNCTION__.'! ID is not setted!');
        }
        $response = $this->api->getClient()->SuspendVM_Task([
            '_this' => [
                '_' => $this->id,
                'type' => self::TYPE,
            ],
        ]);

        return $this->api->getTask()->byID($response->returnval->_);
    }

    public function _RebootGuest(): Task
    {
        if (empty($this->id)) {
            throw new BadCallMethod('Can not call method: '.__CLASS__.'@'.__FUNCTION__.'! ID is not setted!');
        }
        $response = $this->api->getClient()->RebootGuest([
            '_this' => [
                '_' => $this->id,
                'type' => self::TYPE,
            ],
        ]);

        return $this->api->getTask()->byID($response->returnval->_);
    }

    public function _ShutdownGuest(): Task
    {
        if (empty($this->id)) {
            throw new BadCallMethod('Can not call method: '.__CLASS__.'@'.__FUNCTION__.'! ID is not setted!');
        }
        $response = $this->api->getClient()->ShutdownGuest([
            '_this' => [
                '_' => $this->id,
                'type' => self::TYPE,
            ],
        ]);

        return $this->api->getTask()->byID($response->returnval->_);
    }

    public function _UnregisterVM(): Task
    {
        if (empty($this->id)) {
            throw new BadCallMethod('Can not call method: '.__CLASS__.'@'.__FUNCTION__.'! ID is not setted!');
        }
        $response = $this->api->getClient()->UnregisterVM([
            '_this' => [
                '_' => $this->id,
                'type' => self::TYPE,
            ],
        ]);

        return $this->api->getTask()->byID($response->returnval->_);
    }

    public function _ReconfigVM_Task(VirtualMachineConfigSpec $spec): Task
    {
        if (empty($this->id)) {
            throw new BadCallMethod('Can not call method: '.__CLASS__.'@'.__FUNCTION__.'! ID is not setted!');
        }
        $response = $this->api->getClient()->ReconfigVM_Task([
            '_this' => [
                '_' => $this->id,
                'type' => self::TYPE,
            ],
            'spec' => $spec,
        ]);

        return $this->api->getTask()->byID($response->returnval->_);
    }
}
