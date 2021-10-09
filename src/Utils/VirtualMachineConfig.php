<?php

namespace dnj\phpvmomi\Utils;

use dnj\phpvmomi\DataObjects\ToolsConfigInfo;
use dnj\phpvmomi\DataObjects\VirtualAHCIController;
use dnj\phpvmomi\DataObjects\VirtualCdrom;
use dnj\phpvmomi\DataObjects\VirtualCdromAtapiBackingInfo;
use dnj\phpvmomi\DataObjects\VirtualCdromIsoBackingInfo;
use dnj\phpvmomi\DataObjects\VirtualDeviceConfigSpec;
use dnj\phpvmomi\DataObjects\VirtualDeviceConnectInfo;
use dnj\phpvmomi\DataObjects\VirtualDisk;
use dnj\phpvmomi\DataObjects\VirtualDiskFlatVer2BackingInfo;
use dnj\phpvmomi\DataObjects\VirtualE1000;
use dnj\phpvmomi\DataObjects\VirtualEthernetCard;
use dnj\phpvmomi\DataObjects\VirtualEthernetCardNetworkBackingInfo;
use dnj\phpvmomi\DataObjects\VirtualFloppy;
use dnj\phpvmomi\DataObjects\VirtualIDEController;
use dnj\phpvmomi\DataObjects\VirtualLsiLogicController;
use dnj\phpvmomi\DataObjects\VirtualLsiLogicSASController;
use dnj\phpvmomi\DataObjects\VirtualMachineBootOptions;
use dnj\phpvmomi\DataObjects\VirtualMachineBootOptionsBootableCdromDevice;
use dnj\phpvmomi\DataObjects\VirtualMachineBootOptionsBootableDiskDevice;
use dnj\phpvmomi\DataObjects\VirtualMachineBootOptionsBootableEthernetDevice;
use dnj\phpvmomi\DataObjects\VirtualMachineBootOptionsBootableFloppyDevice;
use dnj\phpvmomi\DataObjects\VirtualMachineConfigSpec;
use dnj\phpvmomi\DataObjects\VirtualMachineDefaultPowerOpInfo;
use dnj\phpvmomi\DataObjects\VirtualMachineFileInfo;
use dnj\phpvmomi\DataObjects\VirtualMachineFlagInfo;
use dnj\phpvmomi\DataObjects\VirtualMachineVideoCard;
use dnj\phpvmomi\DataObjects\VirtualPCIController;
use dnj\phpvmomi\DataObjects\VirtualPS2Controller;
use dnj\phpvmomi\DataObjects\VirtualSCSIController;
use dnj\phpvmomi\DataObjects\VirtualSIOController;
use dnj\phpvmomi\DataObjects\VirtualUSBController;
use dnj\phpvmomi\Exception;
use dnj\phpvmomi\ManagedObjects\Datastore;
use dnj\phpvmomi\ManagedObjects\VirtualMachine;

class VirtualMachineConfig extends VirtualMachineConfigSpec
{
    public const SCSI_CONTROLLER = 1;
    public const SCSI_SAS_CONTROLLER = 2;

    public static function forNewVM(string $name, string $version, string $guestId, Datastore $datastore): self
    {
        $template = new self();
        $template->datastore = $datastore;
        $template->name = $name;
        $template->version = $version;
        $template->guestId = $guestId;
        $template->npivTemporaryDisabled = true;
        $template->deviceChange = [];
        $template->swapPlacement = 'inherit';
        $template->firmware = 'bios';
        $template->maxMksConnections = -1;
        $template->nestedHVEnabled = false;
        $template->vPMCEnabled = false;
        $template->files = new VirtualMachineFileInfo();
        $template->files->vmPathName = $datastore->getDatastorePath('/');
        $template->setDefaultTools()
            ->setDefaultFlags()
            ->setDefaultPowerOpInfo()
            ->setDefaultBootOptions()
            ->setDefaultDeviceCreation()
            ->setupCPU(1)
            ->setupRAM(1024);

        return $template;
    }

    public static function forVM(VirtualMachine $vm): self
    {
        $template = new self();
        $template->vm = $vm;

        return $template;
    }

    private $disks = 0;
    private int $scsiController = self::SCSI_CONTROLLER;
    private ?VirtualMachine $vm = null;
    private ?Datastore $datastore = null;

    /**
     * @return static
     */
    public function setupCPU(int $numCPUs, int $numCoresPerSocket = 1, bool $cpuHotAddEnabled = false, bool $cpuHotRemoveEnabled = false)
    {
        $this->numCPUs = $numCPUs;
        $this->numCoresPerSocket = $numCoresPerSocket;
        $this->cpuHotAddEnabled = $cpuHotAddEnabled;
        $this->cpuHotRemoveEnabled = $cpuHotRemoveEnabled;

        return $this;
    }

    /**
     * @return static
     */
    public function setupRAM(int $memoryMB, bool $memoryHotAddEnabled = false)
    {
        $this->memoryMB = $memoryMB;
        $this->memoryHotAddEnabled = $memoryHotAddEnabled;

        return $this;
    }

    /**
     * @return static
     */
    public function useLogicSASController(): self
    {
        $this->scsiController = self::SCSI_SAS_CONTROLLER;

        return $this;
    }

    /**
     * @return static
     */
    public function addDisk(int $capacityInMB, bool $thinProvisioned = true, ?Datastore $datastore = null): self
    {
        if (null === $datastore) {
            $datastore = $this->datastore;
        }
        $device = new VirtualDisk();
        $device->key = -1000000;
        $device->unitNumber = 0;
        $device->backing = new VirtualDiskFlatVer2BackingInfo();
        $device->backing->fileName = $datastore->getDatastorePath($this->name."/{$this->name}-".($this->disks++).'.vmdk');
        $device->backing->datastore = $datastore->ref();
        $device->backing->diskMode = 'persistent';
        $device->backing->thinProvisioned = $thinProvisioned;
        $device->backing->eagerlyScrub = false;
        $device->controllerKey = $this->findOrCreateScsiController()->key;
        $device->capacityInKB = $capacityInMB * 1024;
        $device->capacityInBytes = $capacityInMB * 1024 * 1024;

        $change = new VirtualDeviceConfigSpec($device, 'add');
        $change->fileOperation = 'create';
        $this->addDeviceChange($change);

        return $this;
    }

    /**
     * @return static
     */
    public function addCdrom(?Path $iso = null): self
    {
        $device = new VirtualCdrom();
        $device->key = -1000001;
        if ($iso) {
            $device->backing = new VirtualCdromIsoBackingInfo();
            $device->backing->fileName = $iso->toDSPath();
        } else {
            $device->backing = new VirtualCdromAtapiBackingInfo();
            $device->backing->deviceName = 'Cdrom';
            $device->backing->useAutoDetect = false;
        }

        $device->connectable = new VirtualDeviceConnectInfo();
        $device->connectable->startConnected = true;
        $device->connectable->allowGuestControl = true;
        $device->connectable->connected = true;
        $device->controllerKey = 200;

        $this->addDeviceChange(new VirtualDeviceConfigSpec($device, 'add'));

        return $this;
    }

    /**
     * @param class-string<VirtualEthernetCard>
     *
     * @return static
     */
    public function addNetwork(string $deviceName, ?string $macAddress = null, string $type = VirtualE1000::class): self
    {
        $device = new $type();
        $device->key = -50;
        $device->backing = new VirtualEthernetCardNetworkBackingInfo();
        $device->backing->deviceName = $deviceName;
        $device->connectable = new VirtualDeviceConnectInfo();
        $device->connectable->startConnected = true;
        $device->connectable->allowGuestControl = true;
        $device->connectable->connected = true;
        $device->addressType = $macAddress ? 'Manual' : 'Generated';
        $device->macAddress = $macAddress ?? '00:00:00:00:00:00';
        $this->addDeviceChange(new VirtualDeviceConfigSpec($device, 'add'));

        return $this;
    }

    /**
     * @param string[] $devices value can be a series of ["cdrom", "disk", "ethernet", "floppy"]
     *
     * @return static
     */
    public function setBootOrder(array $devices): self
    {
        $order = [];
        foreach ($devices as $device) {
            $device = strtolower($device);
            if ('floppy' == $device and !$this->hasFloppyDisk()) {
                continue;
            }
            if ('cdrom' == $device and !$this->hasCDRomDisk()) {
                continue;
            }
            switch ($device) {
                case 'cdrom':
                    $order[] = new VirtualMachineBootOptionsBootableCdromDevice();
                    break;
                case 'disk':
                    $device = new VirtualMachineBootOptionsBootableDiskDevice();
                    $device->deviceKey = $this->findFirstDisk()->key;
                    $order[] = $device;
                    break;
                case 'ethernet':
                    $device = new VirtualMachineBootOptionsBootableEthernetDevice();
                    $device->deviceKey = $this->findFirstEthernet()->key;
                    $order[] = $device;
                    break;
                case 'floppy':
                    $order[] = new VirtualMachineBootOptionsBootableFloppyDevice();
                    break;
                default:
                    throw new Exception('unsupported device: '.$device);
            }
        }
        if (!$this->bootOptions) {
            $this->bootOptions = new VirtualMachineBootOptions();
        }
        $this->bootOptions->bootOrder = $order;

        return $this;
    }

    /**
     * @param Path[] $files
     *
     * @return static
     */
    public function mountISO(array $files): self
    {
        $cdroms = $this->getDevicesByType(VirtualCdrom::class);

        for ($x = 0, $l = min(count($files), count($cdroms)); $x < $l; ++$x) {
            $cdrom = $cdroms[$x];
            $cdrom->backing = new VirtualCdromIsoBackingInfo();
            $cdrom->backing->fileName = $files[$x]->toDSPath();
            $cdrom->connectable->allowGuestControl = true;
            $cdrom->connectable->connected = true;
            $cdrom->connectable->startConnected = true;
            $this->addDeviceChange(new VirtualDeviceConfigSpec($cdrom, 'edit'));
        }
        for ($x = count($cdroms), $l = count($files); $x < $l; ++$x) {
            $this->addCdrom($files[$x]);
        }

        return $this;
    }

    /**
     * @return static
     */
    public function unmountISO(): self
    {
        $cdroms = $this->getDevicesByType(VirtualCdrom::class);

        foreach ($cdroms as $cdrom) {
            // $cdrom->backing = new VirtualCdromAtapiBackingInfo();
            // $cdrom->backing->useAutoDetect = true;
            $cdrom->connectable->allowGuestControl = false;
            $cdrom->connectable->connected = false;
            $cdrom->connectable->startConnected = false;
            unset($cdrom->connectable->status);
            $this->addDeviceChange(new VirtualDeviceConfigSpec($cdrom, 'edit'));
        }

        return $this;
    }

    /**
     * @return static
     */
    public function setDefaultTools(): self
    {
        $this->tools = new ToolsConfigInfo();
        $this->tools->afterPowerOn = true;
        $this->tools->afterResume = true;
        $this->tools->beforeGuestStandby = true;
        $this->tools->beforeGuestShutdown = true;
        $this->tools->toolsUpgradePolicy = 'manual';
        $this->tools->syncTimeWithHost = false;

        return $this;
    }

    /**
     * @return static
     */
    public function setDefaultFlags(): self
    {
        $this->flags = new VirtualMachineFlagInfo();
        $this->flags->disableAcceleration = false;
        $this->flags->enableLogging = true;
        $this->flags->monitorType = 'release';
        $this->flags->virtualMmuUsage = 'automatic';
        $this->flags->virtualExecUsage = 'hvAuto';

        return $this;
    }

    /**
     * @return static
     */
    public function setDefaultPowerOpInfo(): self
    {
        $this->powerOpInfo = new VirtualMachineDefaultPowerOpInfo();
        $this->powerOpInfo->powerOffType = 'preset';
        $this->powerOpInfo->suspendType = 'soft';
        $this->powerOpInfo->resetType = 'preset';
        $this->powerOpInfo->defaultPowerOffType = 'hard';

        return $this;
    }

    /**
     * @return static
     */
    public function setDefaultBootOptions(): self
    {
        if (!$this->bootOptions) {
            $this->bootOptions = new VirtualMachineBootOptions();
        }
        $this->bootOptions->bootDelay = 0;
        $this->bootOptions->enterBIOSSetup = false;
        $this->bootOptions->bootRetryEnabled = false;
        $this->bootOptions->bootRetryDelay = 10;

        return $this;
    }

    /**
     * @return static
     */
    public function setDefaultDeviceCreation(): self
    {
        $device = new VirtualIDEController();
        $device->key = 200;
        $device->connectable = new VirtualDeviceConnectInfo();
        $device->connectable->startConnected = true;
        $device->connectable->allowGuestControl = true;
        $device->connectable->connected = true;
        $device->busNumber = 0;
        $device->device = -1000001;
        $this->addDeviceChange(new VirtualDeviceConfigSpec($device, 'add'));

        $device = new VirtualIDEController();
        $device->key = 201;
        $device->connectable = new VirtualDeviceConnectInfo();
        $device->connectable->startConnected = true;
        $device->connectable->allowGuestControl = true;
        $device->connectable->connected = true;
        $device->busNumber = 1;
        $device->device = -1000001;
        $this->addDeviceChange(new VirtualDeviceConfigSpec($device, 'add'));

        $device = new VirtualPCIController();
        $device->key = 100;
        $device->connectable = new VirtualDeviceConnectInfo();
        $device->connectable->startConnected = true;
        $device->connectable->allowGuestControl = true;
        $device->connectable->connected = true;
        $device->busNumber = 0;
        $device->device = -1000001;
        $this->addDeviceChange(new VirtualDeviceConfigSpec($device, 'add'));

        $device = new VirtualPS2Controller();
        $device->key = 300;
        $device->connectable = new VirtualDeviceConnectInfo();
        $device->connectable->startConnected = true;
        $device->connectable->allowGuestControl = true;
        $device->connectable->connected = true;
        $device->busNumber = 0;
        $device->device = -1000001;
        $this->addDeviceChange(new VirtualDeviceConfigSpec($device, 'add'));

        $device = new VirtualSIOController();
        $device->key = 400;
        $device->connectable = new VirtualDeviceConnectInfo();
        $device->connectable->startConnected = true;
        $device->connectable->allowGuestControl = true;
        $device->connectable->connected = true;
        $device->busNumber = 0;
        $device->device = -1000001;
        $this->addDeviceChange(new VirtualDeviceConfigSpec($device, 'add'));

        $device = new VirtualMachineVideoCard();
        $device->key = -51;
        $device->unitNumber = -50;
        $device->videoRamSizeInKB = 4 * 1024;
        $device->numDisplays = 1;
        $device->useAutoDetect = false;
        $device->enable3DSupport = false;
        $this->addDeviceChange(new VirtualDeviceConfigSpec($device, 'add'));

        $device = new VirtualAHCIController();
        $device->key = -690;
        $device->busNumber = 0;
        $this->addDeviceChange(new VirtualDeviceConfigSpec($device, 'add'));

        $device = new VirtualUSBController();
        $device->key = -50;
        $device->busNumber = 0;
        $this->addDeviceChange(new VirtualDeviceConfigSpec($device, 'add'));

        return $this;
    }

    public function findOrCreateScsiController(): VirtualSCSIController
    {
        foreach ($this->deviceChange as $change) {
            if ($change->device instanceof VirtualSCSIController) {
                return $change->device;
            }
        }
        if (self::SCSI_CONTROLLER === $this->scsiController) {
            $device = new VirtualLsiLogicController();
            $device->key = -904;
        } else {
            $device = new VirtualLsiLogicSASController();
            $device->key = -810;
        }
        $device->busNumber = 0;
        $device->sharedBus = 'noSharing';
        $this->addDeviceChange(new VirtualDeviceConfigSpec($device, 'add'));

        return $device;
    }

    /**
     * @template T of VirtualDevice
     *
     * @param class-string<T> $type
     *
     * @return T[]
     */
    public function getDevicesByType(string $type): array
    {
        $devices = [];
        foreach ($this->getOverallDevices() as $device) {
            if (is_a($device, $type, true)) {
                $devices[] = $device;
            }
        }

        return $devices;
    }

    /**
     * @return VirtualDevice[]
     */
    public function getOverallDevices(): array
    {
        $devices = $this->vm->config->hardware->device ?? [];
        if ($this->deviceChange) {
            foreach ($this->deviceChange as $change) {
                $device = null;
                foreach ($devices as $item) {
                    if ($change->device->key === $item->key) {
                        $device = $item;
                        break;
                    }
                }
                if ('add' == $change->operation) {
                    $devices[] = $change->device;
                } elseif ('edit' == $change->operation) {
                    //todo
                } elseif ('delete' == $change->operation) {
                    $i = array_search($device, $devices);
                    if (false !== $i) {
                        array_splice($devices, $i, 1);
                    }
                }
            }
        }

        return $devices;
    }

    public function addDeviceChange(VirtualDeviceConfigSpec $change): void
    {
        $this->deviceChange[] = $change;
    }

    public function findFirstDisk(): ?VirtualDisk
    {
        return $this->getDevicesByType(VirtualDisk::class)[0] ?? null;
    }

    public function findFirstEthernet(): ?VirtualEthernetCard
    {
        return $this->getDevicesByType(VirtualEthernetCard::class)[0] ?? null;
    }

    public function hasFloppyDisk(): bool
    {
        return !empty($this->getDevicesByType(VirtualFloppy::class));
    }

    public function hasCDRomDisk(): bool
    {
        return !empty($this->getDevicesByType(VirtualCdrom::class));
    }
}
