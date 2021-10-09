<?php

namespace dnj\phpvmomi\Tests\ManagedObjects;

use dnj\phpvmomi\ManagedObjects\ResourcePool;
use dnj\phpvmomi\ManagedObjects\VirtualMachine;
use dnj\phpvmomi\Tests\TestCase;

class VirtualMachineTest extends TestCase
{
    public function testGetResourcePool()
    {
        $api = $this->getAPI();
        $vmID = $this->getVmID(false);
        $templateID = $this->getVmTemplateID(false);
        if (!$vmID and !$templateID) {
            $this->markTestSkipped('This test needs VM ID');

            return;
        }
        foreach ([$vmID, $templateID] as $id) {
            if ($id) {
                $vm = (new VirtualMachine($api))->byID($id);
                $this->assertInstanceOf(VirtualMachine::class, $vm);

                $resourcePool = $vm->getResourcePool();
                $this->assertInstanceOf(ResourcePool::class, $resourcePool);
            }
        }
    }
}
