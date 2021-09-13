<?php
namespace dnj\phpvmomi\Exceptions;

use dnj\phpvmomi\Exception;

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