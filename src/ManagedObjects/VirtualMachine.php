<?php
namespace dnj\phpvmomi\ManagedObjects;

use dnj\phpvmomi\DataObjects\Event;
use dnj\phpvmomi\DataObjects\VirtualMachineRuntimeInfo;
use dnj\phpvmomi\Exceptions\BadCallMethod;

/**
 * @todo complete
 * @see https://vdc-download.vmware.com/vmwb-repository/dcr-public/b50dcbbf-051d-4204-a3e7-e1b618c1e384/538cf2ec-b34f-4bae-a332-3820ef9e7773/vim.VirtualMachine.html
 */
class VirtualMachine extends ManagedEntity
{
	use actions\NeedAPITrait,
		actions\VirtualMachineTrait;

	public const TYPE = 'VirtualMachine';

	/**
	 * @var VirtualMachineRuntimeInfo $runtime
	 */
	public $runtime;

	/**
	 * @todo Move to right place
	 */
	const on = 1;
	const off = 2;
	const suspend = 3;
	const running = 1;

	const vmxnet3 = 'VirtualVmxnet3';
	const e1000 = 'VirtualE1000';

	public function _PowerOnVM_Task(): Task
	{
		if (empty($this->id)) {
			throw new BadCallMethod('Can not call method: ' . __CLASS__ . '@' . __FUNCTION__ . '! ID is not setted!');
		}
		$response = $this->api->getClient()->PowerOnVM_Task(array(
			'_this' => array(
				'_' => $this->id,
				'type' => self::TYPE,
			),
		));
		return $this->api->getTask()->byID($response->returnval->_);
	}

	public function _PowerOffVM_Task(): Task
	{
		if (empty($this->id)) {
			throw new BadCallMethod('Can not call method: ' . __CLASS__ . '@' . __FUNCTION__ . '! ID is not setted!');
		}
		$response = $this->api->getClient()->PowerOffVM_Task(array(
			'_this' => array(
				'_' => $this->id,
				'type' => self::TYPE,
			),
		));
		return $this->api->getTask()->byID($response->returnval->_);
	}

	public function _ResetVM_Task(): Task
	{
		if (empty($this->id)) {
			throw new BadCallMethod('Can not call method: ' . __CLASS__ . '@' . __FUNCTION__ . '! ID is not setted!');
		}
		$response = $this->api->getClient()->ResetVM_Task(array(
			'_this' => array(
				'_' => $this->id,
				'type' => self::TYPE,
			),
		));
		return $this->api->getTask()->byID($response->returnval->_);
	}

	public function _SuspendVM_Task(): Task
	{
		if (empty($this->id)) {
			throw new BadCallMethod('Can not call method: ' . __CLASS__ . '@' . __FUNCTION__ . '! ID is not setted!');
		}
		$response = $this->api->getClient()->SuspendVM_Task(array(
			'_this' => array(
				'_' => $this->id,
				'type' => self::TYPE,
			),
		));
		return $this->api->getTask()->byID($response->returnval->_);
	}

	public function _RebootGuest(): Task
	{
		if (empty($this->id)) {
			throw new BadCallMethod('Can not call method: ' . __CLASS__ . '@' . __FUNCTION__ . '! ID is not setted!');
		}
		$response = $this->api->getClient()->RebootGuest(array(
			'_this' => array(
				'_' => $this->id,
				'type' => self::TYPE,
			),
		));
		return $this->api->getTask()->byID($response->returnval->_);
	}

	public function _ShutdownGuest(): Task
	{
		if (empty($this->id)) {
			throw new BadCallMethod('Can not call method: ' . __CLASS__ . '@' . __FUNCTION__ . '! ID is not setted!');
		}
		$response = $this->api->getClient()->ShutdownGuest(array(
			'_this' => array(
				'_' => $this->id,
				'type' => self::TYPE,
			),
		));
		return $this->api->getTask()->byID($response->returnval->_);
	}

	public function _UnregisterVM(): Task
	{
		if (empty($this->id)) {
			throw new BadCallMethod('Can not call method: ' . __CLASS__ . '@' . __FUNCTION__ . '! ID is not setted!');
		}
		$response = $this->api->getClient()->UnregisterVM(array(
			'_this' => array(
				'_' => $this->id,
				'type' => self::TYPE,
			),
		));
		return $this->api->getTask()->byID($response->returnval->_);
	}

}
