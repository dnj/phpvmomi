<?php
namespace dnj\phpvmomi\ManagedObjects\Custom;

use dnj\phpvmomi\API;
use dnj\phpvmomi\ManagedObjects\Task;
use dnj\phpvmomi\ManagedObjects\Datastore;
use dnj\phpvmomi\ManagedObjects\actions\NeedAPITrait;

class File
{
	use NeedAPITrait;

	protected $datastore;
	protected $path;
	public function __construct(API $api, Datastore $datastore, string $path)
	{
		$this->api = $api;
		$this->datastore = $datastore;
		$this->setPath($path);
	}

	public function getPath(): string
	{
		return $this->path;
	}

	public function getDatastore(): Datastore
	{
		return $this->datastore;
	}

	public function getURL(): string
	{
		return $this->datastore->url.'/'.$this->path;
	}

	public function __toString(): string
	{
		return "[".$this->datastore->vmfs->name."] ".$this->path;
	}

	public function __get(string $key)
	{
		if(in_array($key, ['datastore', 'path'])){
			return $this->$key;
		}elseif($key == 'url'){
			return $this->getURL();
		}
		return null;
	}
	public function delete(): Task
	{
		return $this->api->getFileManager()->_DeleteDatastoreFile_Task($this->__toString());
	}
	private function setPath(string $path): void
	{
		while(substr($path, 0, 1) == '/'){
			$path = substr($path, 1);
		}
		$this->path = $path;
	}
}