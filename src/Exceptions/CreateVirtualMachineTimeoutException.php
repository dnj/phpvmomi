<?php

namespace dnj\phpvmomi\Exceptions;

use dnj\phpvmomi\Exception;

class CreateVirtualMachineTimeoutException extends Exception
{
    public function __construct($timeout)
    {
        $this->message = 'Can not create machine in given timeout! ('.$timeout.')';
    }
}
