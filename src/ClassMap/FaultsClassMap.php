<?php
namespace DNJ\PHPVMOMI\ClassMap;

use DNJ\PHPVMOMI\Faults;

class FaultsClassMap
{
	const CLASS_MAP = [
		'InvalidLocaleFault' => Faults\InvalidLocaleFault::class,
		'InvalidLoginFault' => Faults\InvalidLoginFault::class,
		'MethodFault' => Faults\MethodFault::class,
		'VimFault' => Faults\VimFault::class,
	];
}
