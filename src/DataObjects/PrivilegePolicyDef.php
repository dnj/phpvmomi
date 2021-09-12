<?php
namespace DNJ\PHPVMOMI\DataObjects;

/**
 * Describes a basic privilege policy.
 *
 * @see https://vdc-download.vmware.com/vmwb-repository/dcr-public/b50dcbbf-051d-4204-a3e7-e1b618c1e384/538cf2ec-b34f-4bae-a332-3820ef9e7773/vim.PrivilegePolicyDef.html
 */
class PrivilegePolicyDef extends DynamicData
{
	/**
	 * @var string $createPrivilege Name of privilege required for creation. 
	 */
	protected $createPrivilege;

	/**
	 * @var string $deletePrivilege Name of privilege required for deleting. 
	 */
	protected $deletePrivilege;

	/**
	 * @var string $readPrivilege Name of privilege required for reading. 
	 */
	protected $readPrivilege;

	/**
	 * @var string $updatePrivilege Name of privilege required for updating. 
	 */
	protected $updatePrivilege;
}
