<?php

namespace dnj\phpvmomi\ManagedObjects;

use dnj\phpvmomi\DataObjects\GuestAuthentication;
use dnj\phpvmomi\DataObjects\GuestProcessInfo;
use dnj\phpvmomi\DataObjects\GuestProgramSpec;
use dnj\phpvmomi\DataObjects\ManagedObjectReference;

/**
 * @see https://vdc-download.vmware.com/vmwb-repository/dcr-public/b50dcbbf-051d-4204-a3e7-e1b618c1e384/538cf2ec-b34f-4bae-a332-3820ef9e7773/vim.vm.guest.GuestProcessManager.html
 */
class GuestProcessManager extends ManagedEntity
{
    /**
     * @param int[] $pids
     *
     * @return GuestProcessInfo[]
     */
    public function _ListProcessesInGuest(ManagedObjectReference $vm, GuestAuthentication $auth, ?array $pids = null): array
    {
        $list = $this->api->getClient()->ListProcessesInGuest([
            '_this' => $this->ref(),
            'vm' => $vm,
            'auth' => $auth,
            'pids' => $pids,
        ])->returnval ?? [];
        if (!is_array($list)) {
            $list = [$list];
        }

        return $list;
    }

    /**
     * @param string[] $names
     *
     * @return string[]
     */
    public function _ReadEnvironmentVariableInGuest(ManagedObjectReference $vm, GuestAuthentication $auth, ?array $names = null): array
    {
        return $this->api->getClient()->ReadEnvironmentVariableInGuest([
            '_this' => $this->ref(),
            'vm' => $vm,
            'auth' => $auth,
            'names' => $names,
        ])->returnval ?? [];
    }

    public function _StartProgramInGuest(ManagedObjectReference $vm, GuestAuthentication $auth, GuestProgramSpec $spec): int
    {
        return $this->api->getClient()->StartProgramInGuest([
            '_this' => $this->ref(),
            'vm' => $vm,
            'auth' => $auth,
            'spec' => $spec,
        ])->returnval;
    }

    public function _TerminateProcessInGuest(ManagedObjectReference $vm, GuestAuthentication $auth, int $pid): void
    {
        $this->api->getClient()->TerminateProcessInGuest([
            '_this' => $this->ref(),
            'vm' => $vm,
            'auth' => $auth,
            'pid' => $pid,
        ]);
    }
}
