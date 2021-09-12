<?php
namespace DNJ\PHPVMOMI\DataObjects;

/**
 * Base type for storing values.
 *
 * @see https://vdc-download.vmware.com/vmwb-repository/dcr-public/b50dcbbf-051d-4204-a3e7-e1b618c1e384/538cf2ec-b34f-4bae-a332-3820ef9e7773/vim.CustomFieldsManager.Value.html
 */
class CustomFieldValue extends DynamicData
{
	/**
	 * @var int $key The ID of the field to which this value belongs.
	 */
	protected $key;
}
