<?php

namespace dnj\phpvmomi\DataObjects;

use stdClass;

/**
 * DynamicData is a builtin object model data object type for manipulating data properties dynamically.
 * The primary usage is as a base class for types that may be extended with subtypes in the future, where new properties should be sent to old clients as a set of dynamic properties.
 *
 * @since vmodl.version.version0
 * @see https://vdc-download.vmware.com/vmwb-repository/dcr-public/b50dcbbf-051d-4204-a3e7-e1b618c1e384/538cf2ec-b34f-4bae-a332-3820ef9e7773/vmodl.DynamicData.html
 */
class DynamicData extends stdClass
{
    public function getSoapData()
    {
        $keys = [];
        if (isset($this->SoapDataOrder)) {
            $keys = $this->SoapDataOrder;
        } else {
            $keys = self::getClassVars($this);
        }
        foreach ($keys as $key) {
            if (is_object($this->$key) and (($this->$key) instanceof DynamicData)) {
                ($this->$key)->getSoapData();
            }
        }
    }

    public function __set(string $key, $value): void
    {
        $this->$key = $value;
    }

    public function __get(string $key)
    {
        if (isset($this->$key)) {
            return $this->$key;
        }
    }

    public static function getClassVars($class)
    {
        $vars = [];
        if ($class) {
            $parent = get_parent_class($class);
            foreach (self::getClassVars($parent) as $key) {
                $vars[] = $key;
            }
            if (!is_string($class)) {
                $class = get_class($class);
            }
            $keys = array_keys(get_class_vars($class));
            foreach ($keys as $key) {
                if (!in_array($key, $vars)) {
                    $vars[] = $key;
                }
            }
        }

        return $vars;
    }
}
