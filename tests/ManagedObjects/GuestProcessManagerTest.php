<?php

namespace dnj\phpvmomi\Tests\ManagedObjects;

use dnj\phpvmomi\DataObjects\GuestProgramSpec;
use dnj\phpvmomi\DataObjects\NamePasswordAuthentication;
use dnj\phpvmomi\ManagedObjects\GuestProcessManager;
use dnj\phpvmomi\ManagedObjects\VirtualMachine;
use dnj\phpvmomi\Tests\TestCase;

class GuestProcessManagerTest extends TestCase
{
    public function testListProcessesInGuest()
    {
        $api = $this->getAPI();
        $vmID = $this->getVmID();

        $username = $this->getVMUsername();
        $password = $this->getVMPassword();

        $vm = (new VirtualMachine($api))->byID($vmID);
        $this->assertInstanceOf(VirtualMachine::class, $vm);

        if (!$vm->guest or 'guestToolsRunning' != $vm->guest->toolsRunningStatus) {
            $this->markTestSkipped('There is no running VM Tools on vm');

            return;
        }

        $processManager = $api->getGuestOperationsManager()->processManager->init($this->api);
        $this->assertInstanceOf(GuestProcessManager::class, $processManager);

        $auth = new NamePasswordAuthentication($username, $password, false);
        $processes = $processManager->_ListProcessesInGuest($vm->ref(), $auth);
        $this->assertIsArray($processes);
    }

    public function testStartProgramInGuest()
    {
        $api = $this->getAPI();
        $vmID = $this->getVmID();

        $username = $this->getVMUsername();
        $password = $this->getVMPassword();

        $vm = (new VirtualMachine($api))->byID($vmID);
        $this->assertInstanceOf(VirtualMachine::class, $vm);

        if (!$vm->guest or 'guestToolsRunning' != $vm->guest->toolsRunningStatus) {
            $this->markTestSkipped('There is no running VM Tools on vm');

            return;
        }

        $processManager = $api->getGuestOperationsManager()->processManager->init($this->api);
        $this->assertInstanceOf(GuestProcessManager::class, $processManager);

        $auth = new NamePasswordAuthentication($username, $password, false);
        $process = new GuestProgramSpec("C:\\Windows\\System32\cmd.exe", '/c "echo Hello"');
        $pid = $processManager->_StartProgramInGuest($vm->ref(), $auth, $process);
        $this->assertIsInt($pid);
    }
}
