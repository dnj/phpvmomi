<?php
namespace dnj\phpvmomi\Faults;

use dnj\phpvmomi\Exception;
use dnj\phpvmomi\DataObjects;

/**
 * @todo complete methods
 * @see https://vdc-download.vmware.com/vmwb-repository/dcr-public/b50dcbbf-051d-4204-a3e7-e1b618c1e384/538cf2ec-b34f-4bae-a332-3820ef9e7773/vmodl.MethodFault.html
 */
class MethodFault extends Exception
{
	/**
	 * @var DataObjects\LocalizedMethodFault $faultCause Fault which is the cause of this fault.
	 */
	public $faultCause;

	/**
	 * @var DataObjects\LocalizableMessage[] $faultMessage Message which has details about the error Message can also contain a key to message catalog which can be used to generate better localized messages. 
	 */
	public $faultMessage;

}
