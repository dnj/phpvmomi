<?php

namespace dnj\phpvmomi\DataObjects\actions;

use dnj\phpvmomi\API;
use dnj\phpvmomi\ManagedObjects\ManagedEntity;

trait ManagedObjectReferenceTrait
{
    public function init(API $api): ManagedEntity
    {
        /**
         * @var class-string<ManagedEntity>
         */
        $className = 'dnj\\phpvmomi\\ManagedObjects\\'.$this->type;
        $object = new $className($api);
        $object->id = $this->_;

        return $object;
    }

    public function get(API $api): ManagedEntity
    {
        $cache = $api->getManagedObjectCache($this->type, $this->_);
        if ($cache) {
            return $cache;
        }
        $object = $this->init($api);
        $object->reloadFromAPI();
        $api->addToManagedObjectCache($object);

        return $object;
    }
}
