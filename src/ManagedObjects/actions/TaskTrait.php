<?php
namespace dnj\phpvmomi\ManagedObjects\actions;

use dnj\phpvmomi\API;
use dnj\phpvmomi\ManagedObjects\Task;
use dnj\phpvmomi\DataObjects\DynamicData;

trait TaskTrait
{
	public function byID(string $id)
	{
		$response = $this->api->getPropertyCollector()->_RetrieveProperties(array(
			'propSet' => array(
				'type' => self::TYPE,
				'all' => true,
				'pathSet' => [],
			),
			'objectSet' => array(
				'obj' => array(
					'type' => self::TYPE,
					'_' => $id,
				),
				'skip' => false,
			),
		));
		return self::fromAPI($this->api, $response->returnval, $this);
	}

	private static function fromAPI(API $api, DynamicData $response, Task $task = null): self
	{
		if ($task == null) {
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
		$task->error = isset($info->error) ? $info->error :null;
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

	protected $api;
	protected $id;
	protected $name;
	protected $description;
	protected $entity;
	protected $state;
	protected $cancelled;
	protected $cancelable;
	protected $error;
	protected $queueTime;
	protected $startTime;
	protected $completeTime;
	protected $result;
	
}