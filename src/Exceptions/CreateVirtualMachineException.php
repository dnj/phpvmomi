<?php
namespace dnj\phpvmomi\Exceptions;

use dnj\phpvmomi\Exception;

class CreateVirtualMachineException extends Exception
{
	private $config;

	public function __construct(string $message, array $config){
		parent::__construct("virtual machine create failed, {$message}");
		$this->config = $config;
	}

	public function getConfig():array{
		return $this->config;
	}
}
