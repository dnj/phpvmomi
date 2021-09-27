<?php

namespace dnj\phpvmomi\Exceptions;

use dnj\phpvmomi\Exception;

class MissingOptionException extends Exception
{
    /**
     * @var string the name of the missed option
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
