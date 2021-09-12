<?php
namespace DNJ\PHPVMOMI\Exceptions;

use DNJ\PHPVMOMI\Exception;

class RequiredConfigException extends Exception {
	/**
	 * @var string $config the name of the missed option
	 */
	protected $config;

	public function __construct(string $config)
	{
		parent::__construct("{$config} config is missing");
		$this->config = $config;
	}

	public function getConfig(): string
	{
		return $this->config;
	}
}