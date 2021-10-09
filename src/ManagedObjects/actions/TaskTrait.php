<?php

namespace dnj\phpvmomi\ManagedObjects\actions;

use dnj\phpvmomi\Faults\MethodFault;

trait TaskTrait
{
    public function waitFor(int $timeout = 0): bool
    {
        $startTime = time();
        while (0 == $timeout or time() - $startTime < $timeout) {
            if ('queued' != $this->info->state and 'running' !== $this->info->state) {
                if ('error' == $this->info->state) {
                    if ($this->info->error) {
                        $fault = new MethodFault($this->info->error->localizedMessage);
                        $fault->faultCause = $this->info->error;
                        throw $fault;
                    }

                    return false;
                }

                return true;
            }
            usleep(300000);
            $this->reloadFromAPI();
        }

        return false;
    }
}
