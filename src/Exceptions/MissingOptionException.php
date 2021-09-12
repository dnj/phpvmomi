<?php
namespace DNJ\PHPVMOMI\Exceptions;

use DNJ\PHPVMOMI\Exception;

class MissingOptionException extends Exception {
	/**
	 * @var string $option the name of the missed option
	 */
	protected $option;

	public function __construct(string $option)
	{
		parent::__construct("{$option} option is missing");
		$this->option = $option;
	}

	public function getOption(): string
	{
		return $this->option;
	}
}