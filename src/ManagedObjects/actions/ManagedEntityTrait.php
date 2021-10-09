<?php

namespace dnj\phpvmomi\ManagedObjects\actions;

use dnj\phpvmomi\DataObjects\ManagedObjectReference;
use dnj\phpvmomi\DataObjects\ObjectContent;
use dnj\phpvmomi\DataObjects\ObjectSpec;
use dnj\phpvmomi\DataObjects\PropertyFilterSpec;
use dnj\phpvmomi\DataObjects\PropertySpec;
use dnj\phpvmomi\Exception;

trait ManagedEntityTrait
{
    public ?string $id = null;

    public function type(): string
    {
        $class = get_class($this);

        return substr($class, strrpos($class, '\\') + 1);
    }

    public function ref(): ManagedObjectReference
    {
        if (!$this->id) {
            throw new Exception("property 'id' is empty");
        }

        return new ManagedObjectReference($this->type(), $this->id);
    }

    /**
     * @return static
     */
    public function createNew(?string $id = null): self
    {
        $obj = new static($this->api);
        $obj->id = $id;

        return $obj;
    }

    /**
     * @return static
     */
    public function byID(string $id, ?array $paths = null): self
    {
        $obj = $this->createNew($id);
        $obj->reloadFromAPI($paths);

        return $obj;
    }

    public function reloadFromAPI(?array $paths = null): void
    {
        $propSet = new PropertySpec($this->type());
        $objectSet = new ObjectSpec($this->ref());
        $spec = new PropertyFilterSpec([$objectSet], [$propSet]);
        $result = $this->api->getPropertyCollector()->retrieveAllProperties([$spec]);
        if ($result) {
            $this->fromObjectContent($result[0]);
        }
    }

    /**
     * @return static
     */
    public function fromObjectContent(ObjectContent $objectContent): self
    {
        $this->id = $objectContent->obj->_;
        if ($objectContent->propSet) {
            foreach ($objectContent->propSet as $prop) {
                $this->{$prop->name} = $prop->val;
            }
        }

        return $this;
    }
}
