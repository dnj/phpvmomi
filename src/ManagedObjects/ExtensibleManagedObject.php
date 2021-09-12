<?php
namespace DNJ\PHPVMOMI\ManagedObjects;

use DNJ\PHPVMOMI\DataObjects\CustomFieldDef;
use DNJ\PHPVMOMI\DataObjects\CustomFieldValue;

/**
 * ExtensibleManagedObject provides methods and properties that provide access to custom fields that may be associated with a managed object.
 * Use the CustomFieldsManager to define custom fields.
 * The CustomFieldsManager handles the entire list of custom fields on a server.
 * You can can specify the object type to which a particular custom field applies by setting its managedObjectType.
 * (If you do not set a managed object type for a custom field definition, the field applies to all managed objects.) 
 *
 * Required privilege: System.View
 *
 * @see https://vdc-download.vmware.com/vmwb-repository/dcr-public/b50dcbbf-051d-4204-a3e7-e1b618c1e384/538cf2ec-b34f-4bae-a332-3820ef9e7773/vim.ExtensibleManagedObject.html
 */
class ExtensibleManagedObject
{
	use actions\NeedAPITrait;

	/**
	 * @var CustomFieldDef[] $availableField List of custom field definitions that are valid for the object's type. The fields are sorted by name. 
	 * @since VI API 2.5
	 */
	protected $availableField;

	/**
	 * @var CustomFieldValue[] $value List of custom field values. Each value uses a key to associate an instance of a CustomFieldStringValue with a custom field definition. 
	 * @since VI API 2.5
	 */
	protected $value;

	/**
	 * Assigns a value to a custom field.
	 * The setCustomValue method requires whichever updatePrivilege is defined as one of the fieldInstancePrivileges for the CustomFieldDef whose value is being changed.
	 */
	public function _setCustomValue(): void
	{

	}
}
