<?php

namespace dnj\phpvmomi\ManagedObjects\actions;

use dnj\phpvmomi\DataObjects\ObjectContent;
use dnj\phpvmomi\DataObjects\PropertyFilterSpec;
use dnj\phpvmomi\DataObjects\RetrieveOptions;

trait PropertyCollectorTrait
{
    /**
     * @param PropertyFilterSpec[] $specSet
     *
     * @return ObjectContent[]
     */
    public function retrieveAllProperties(array $specSet, ?RetrieveOptions $options = null): array
    {
        $objects = [];
        $result = $this->_RetrievePropertiesEx($specSet, $options);
        while (true) {
            if (null === $result) {
                break;
            }
            if (is_array($result->objects)) {
                array_push($objects, ...$result->objects);
            } else {
                $objects[] = $result->objects;
            }
            if (null === $result->token) {
                break;
            }
            $result = $this->_ContinueRetrievePropertiesEx($result->token);
        }

        return $objects;
    }
}
