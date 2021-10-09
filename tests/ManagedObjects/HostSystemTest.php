<?php

namespace dnj\phpvmomi\Tests\ManagedObjects;

use dnj\phpvmomi\ManagedObjects\Datacenter;
use dnj\phpvmomi\ManagedObjects\HostSystem;
use dnj\phpvmomi\ManagedObjects\ResourcePool;
use dnj\phpvmomi\Tests\TestCase;

class HostSystemTest extends TestCase
{
    public function testGetResourcePool()
    {
        $api = $this->getAPI();
        $hostID = $this->getHostID();

        $host = (new HostSystem($api))->byID($hostID);
        $this->assertInstanceOf(HostSystem::class, $host);

        $resourcePool = $host->getResourcePool();
        $this->assertInstanceOf(ResourcePool::class, $resourcePool);
    }

    public function testGetDatacenter()
    {
        $api = $this->getAPI();
        $hostID = $this->getHostID();

        $host = (new HostSystem($api))->byID($hostID);
        $this->assertInstanceOf(HostSystem::class, $host);

        $datacenter = $host->getDatacenter();
        $this->assertInstanceOf(Datacenter::class, $datacenter);
    }
}
