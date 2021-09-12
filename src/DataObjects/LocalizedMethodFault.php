<?php
namespace DNJ\PHPVMOMI\DataObjects;

use DNJ\PHPVMOMI\Faults\MethodFault;

/**
 * @see https://vdc-download.vmware.com/vmwb-repository/dcr-public/b50dcbbf-051d-4204-a3e7-e1b618c1e384/538cf2ec-b34f-4bae-a332-3820ef9e7773/vmodl.LocalizedMethodFault.html
 */
class LocalizedMethodFault extends DynamicData
{
	/**
	 * @var MethodFault $apiType
	 */
	public $fault;

	/**
	 * @var string $localizedMessage The localized message that would be sent in the faultstring element of the SOAP Fault.
	 * 								It is optional so that clients are not required to send a localized message to the server, but servers are required to send the localized message to clients.
	 */
	public $localizedMessage;
}
