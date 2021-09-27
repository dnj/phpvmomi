<?php

namespace dnj\phpvmomi\ManagedObjects\actions;

use dnj\phpvmomi\API;
use dnj\phpvmomi\DataObjects\DynamicData;
use dnj\phpvmomi\ManagedObjects\Task;

trait TaskTrait
{
    public function byID(string $id)
    {
        $response = $this->api->getPropertyCollector()->_RetrieveProperties([
            'propSet' => [
                'type' => self::TYPE,
                'all' => true,
                'pathSet' => [],
            ],
            'objectSet' => [
                'obj' => [
                    'type' => self::TYPE,
                    '_' => $id,
                ],
                'skip' => false,
            ],
        ]);

        return self::fromAPI($this->api, $response->returnval, $this);
    }

    public function waitFor(int $timeout = 0): bool
    {
        if (self::running != $this->state) {
            return true;
        }
        $startTime = time();
        while (0 == $timeout or time() - $startTime < $timeout) {
            $this->byID($this->id);
            if (self::running != $this->state) {
                return true;
            }
            usleep(300000);
        }

        return false;
    }

    private static function fromAPI(API $api, DynamicData $response, Task $task = null): self
    {
        if (null == $task) {
            $task = new self($api);
        }
        $task->id = $response->obj->_;
        $info = self::getPropertyByName('info', $response->propSet);
        $task->name = $info->name;
        $task->description = $info->descriptionId;
        $task->entity = isset($info->entity) ? $info->entity : null;
        if (isset($info->entityName, $info->entity)) {
            $task->entity->name = $info->entityName;
        }
        $task->state = $info->state;
        $task->cancelled = $info->cancelled;
        $task->cancelable = $info->cancelable;
        $task->error = isset($info->error) ? $info->error : null;
        $task->queueTime = strtotime($info->queueTime);
        $task->startTime = isset($info->startTime) ? strtotime($info->startTime) : null;
        $task->completeTime = isset($info->completeTime) ? strtotime($info->completeTime) : null;
        $task->result = $info->result ?? null;

        return $task;
    }

    private static function getPropertyByName(string $name, array $propset)
    {
        foreach ($propset as $prop) {
            if ($prop->name == $name) {
                return $prop->val;
            }
        }

        return null;
    }

    public $id;
    public $description;
    public $entity;
    public $state;
    public $cancelled;
    public $cancelable;
    public $error;
    public $queueTime;
    public $startTime;
    public $completeTime;
    public $result;
}
