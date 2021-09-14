<?php
namespace dnj\phpvmomi\Exceptions;

use dnj\phpvmomi\Exception;

class CreateVirtualMachineException extends Exception
{
	private $config;

	public function __construct(array $config){
		parent::__construct("virtual machine create failed");
		$this->config = $config;
	}

	public function getConfig():array{
		return $this->config;
	}
}
