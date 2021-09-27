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
     * @var PrivilegePolicyDef The set of privileges to apply on this field definition
     *
     * @since VI API 2.5
     */
    protected $fieldDefPrivileges;

    /**
     * @var PrivilegePolicyDef The set of privileges to apply on instances of this field
     *
     * @since VI API 2.5
     */
    protected $fieldInstancePrivileges;

    /**
     * @var int A unique ID used to reference this custom field in assignments. This ID is unique for the lifetime of the field (even across rename operations).
     */
    protected $key;

    /**
     * @var string Type of object for which the field is valid. If not specified, the field is valid for all managed objects.
     *
     * @since VI API 2.5
     */
    protected $managedObjectType;

    /**
     * @var string name of the field
     */
    protected $name;

    /**
     * @var string type of the field
     */
    protected $type;
}
