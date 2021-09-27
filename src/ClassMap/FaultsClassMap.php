<?php

namespace dnj\phpvmomi\ClassMap;

use dnj\phpvmomi\Faults;

class FaultsClassMap
{
    public const CLASS_MAP = [
        'InvalidLocaleFault' => Faults\InvalidLocaleFault::class,
        'InvalidLoginFault' => Faults\InvalidLoginFault::class,
        'MethodFault' => Faults\MethodFault::class,
        'VimFault' => Faults\VimFault::class,
        'ManagedObjectNotFoundFault' => Faults\ManagedObjectNotFoundFault::class,
    ];
}
