<?php

namespace dnj\phpvmomi\ManagedObjects;

use dnj\phpvmomi\API;

/**
 * @see https://vdc-download.vmware.com/vmwb-repository/dcr-public/b50dcbbf-051d-4204-a3e7-e1b618c1e384/538cf2ec-b34f-4bae-a332-3820ef9e7773/vim.Datacenter.html
 */
class Datacenter extends ManagedEntity
{
    use actions\NeedAPITrait;

    public static function fromPropertyCollector(API $api, $response)
    {
        $obj = new self($api);
        $obj->id = $response->obj->_;
        foreach ($response->propSet as $prop) {
            $obj->{$prop->name} = $prop->val;
        }

        return $obj;
    }

    public $id;

    public function byID(string $id)
    {
        $result = $this->api->getPropertyCollector()->_RetrieveProperties([
            'propSet' => [
                'type' => 'Datacenter',
                'all' => true,
            ],
            'objectSet' => [
                'obj' => [
                    'type' => 'Datacenter',
                    '_' => $id,
                ],
                'skip' => false,
            ],
        ]);

        return $this->frompropertyCollector($this->api, $result->returnval);
    }
}
