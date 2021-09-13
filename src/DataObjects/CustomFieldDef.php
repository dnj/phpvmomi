<?php
namespace dnj\phpvmomi\DataObjects;

/**
 * Describes a custom field.
 *
 * @see https://vdc-download.vmware.com/vmwb-repository/dcr-public/b50dcbbf-051d-4204-a3e7-e1b618c1e384/538cf2ec-b34f-4bae-a332-3820ef9e7773/vim.CustomFieldsManager.FieldDef.html
 */
class CustomFieldDef extends DynamicData
{
	/**
	 * @var PrivilegePolicyDef $fieldDefPrivileges The set of privileges to apply on this field definition
	 * @since VI API 2.5
	 */
	protected $fieldDefPrivileges;

	/**
	 * @var PrivilegePolicyDef $fieldInstancePrivileges The set of privileges to apply on instances of this field
	 * @since VI API 2.5
	 */
	protected $fieldInstancePrivileges;

	/**
	 * @var int $key A unique ID used to reference this custom field in assignments. This ID is unique for the lifetime of the field (even across rename operations). 
	 */
	protected $key;

	/**
	 * @var string $managedObjectType Type of object for which the field is valid. If not specified, the field is valid for all managed objects. 
	 * @since VI API 2.5
	 */
	protected $managedObjectType;

	/**
	 * @var string $name Name of the field. 
	 */
	protected $name;

	/**
	 * @var string $type Type of the field. 
	 */
	protected $type;
}
