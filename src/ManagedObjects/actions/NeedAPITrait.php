<?php

namespace dnj\phpvmomi\ManagedObjects\actions;

use dnj\phpvmomi\API;

trait NeedAPITrait
{
    /**
     * @var API
     */
    protected $api;

    final public function __construct(API $api)
    {
        $this->api = $api;
    }

    public function setAPI(API $api): void
    {
        $this->api = $api;
        foreach (get_class_vars(static::class) as $key => $value) {
            if (is_object($value) and method_exists($value, 'setAPI') and property_exists($value, 'api') and null === $value->api) {
                $value->setAPI($api);
            }
        }
    }

    public function getAPI(): API
    {
        return $this->api;
    }
}
