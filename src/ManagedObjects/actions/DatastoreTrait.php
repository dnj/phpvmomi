<?php
namespace dnj\phpvmomi\ManagedObjects\actions;

use SoapVar;
use dnj\phpvmomi\API;
use dnj\phpvmomi\Exception;
use dnj\phpvmomi\ManagedObjects\Datastore;
use dnj\phpvmomi\ManagedObjects\Datacenter;
use dnj\phpvmomi\ManagedObjects\Custom\File;
use dnj\phpvmomi\DataObjects\DynamicData;

trait DatastoreTrait
{
	public $vmfs;

	public function list()
	{
		$response = $this->api->getPropertyCollector()->_RetrievePropertiesEx(array(
			'propSet' => array(
				'type' => 'Datastore',
				'all' => true
			),
			'objectSet' => array(
				'obj' => $this->api->getServiceContent()->rootFolder,
				'skip' => false,
				'selectSet' => array(
					new SoapVar(array(
						'name' => 'FolderTraversalSpec',
						'type' => 'Folder',
						'path' => 'childEntity',
						'skip' => false,
						new SoapVar(array("name" => "FolderTraversalSpec"), SOAP_ENC_OBJECT, null, null, 'selectSet'),
						new SoapVar(array("name" => "DataCenterVMTraversalSpec"), SOAP_ENC_OBJECT, null, null, 'selectSet')
					), SOAP_ENC_OBJECT, 'TraversalSpec'),
					new soapvar(array(
						'name' => 'DataCenterVMTraversalSpec',
						'type' => 'Datacenter',
						'path' => 'datastoreFolder',
						'skip' => false,
						'selectSet' => (object)array("name" => "FolderTraversalSpec")
					), SOAP_ENC_OBJECT, 'TraversalSpec')
				)
			)
		))->returnval;
		if (!is_array($response)) {
			$response = [$response];
		}
		$datastores = [];
		foreach($response as $ds){
			$datastores[] = self::fromAPI($this->api, $ds);
		}
		return $datastores;
	}

	public function file(string $path): File
	{
		return new File($this->api, $this, $path);
	}

	public function getDatacenter(): Datacenter
	{
		$result = $this->api->getPropertyCollector()->_RetrieveProperties(array(
			'propSet' => array(
				'type' => 'Datacenter',
				'all' => true
			),
			'objectSet' => array(
				'obj' => array(
					'type' => 'Datastore',
					'_' => $this->id
				),
				'skip' => false,
				'selectSet' => array(
					new SoapVar(array(
						'name' => 'FolderTraversalSpec',
						'type' => 'ManagedEntity',
						'path' => 'parent',
						'skip' => false,
						new SoapVar(array(
							"name" => "FolderTraversalSpec"
						), SOAP_ENC_OBJECT, null, null, 'selectSet'),
						new SoapVar(array("name" => "DataCenterVMTraversalSpec"), SOAP_ENC_OBJECT, null, null, 'selectSet')
					), SOAP_ENC_OBJECT, 'TraversalSpec'),
					new soapvar(array(
						'name' => 'DataCenterVMTraversalSpec',
						'type' => 'Datacenter',
						'path' => 'parent',
						'skip' => false,
						'selectSet' => (object)array("name" => "FolderTraversalSpec")
					), SOAP_ENC_OBJECT, 'TraversalSpec'),
				),
			),
		));
		return Datacenter::fromPropertyCollector($this->api, $result->returnval);
	}

	public function browse(string $path)
	{
		$task = $this->api->getClient()->SearchDatastore_Task(array(
			'_this' => $this->browser,
			'datastorePath' => "[$this->name] $path",
			'searchSpec' => array(
				'details' => array(
					'fileType' => true,
					'fileSize' => true,
					'modification' => true,
					'fileOwner' => true,
				),
				'sortFoldersFirst' => true,
			)
		))->returnval;
		$task = $this->api->getTask()->byID($task->_);
		if (!$task->waitFor(60)) {
			throw new Exception("timeout task");
		}
		if ($task->error) {
			throw new Exception($task->error->localizedMessage);
		}
		if (!isset($task->result->file)) {
			return [];
		}
		if (!is_array($task->result->file)) {
			return array($task->result->file);
		}
		return $task->result->file;
	}

	public function mkdir(string $path): void
	{
		$this->api->getClient()->MakeDirectory(array(
			'_this' => $this->api->getServiceContent()->fileManager,
			'name' => "[$this->name] $path",
		));
	}

	public function __toString(){
		return $this->vmfs->uuid;
	}

	public static function fromAPI(API $api, DynamicData $response, ?Datastore $datastore = null):Datastore{

		if ($datastore == null) {
			$datastore = new self($api);
		}

		$info = self::getPropertyByName('info', $response->propSet);

		$datastore->id = $response->obj->_;
		$datastore->browser = self::getPropertyByName('browser', $response->propSet);
		$datastore->capability = self::getPropertyByName('capability', $response->propSet);
		$datastore->host = self::getPropertyByName('host', $response->propSet);
		$datastore->info = $info;
		$datastore->name = $info->name;
		$datastore->iormConfiguration = self::getPropertyByName('iormConfiguration', $response->propSet);
		$datastore->summary = self::getPropertyByName('summary', $response->propSet);
		$datastore->configStatus = self::getPropertyByName('configStatus', $response->propSet);
		$datastore->vm = self::getPropertyByName('vm', $response->propSet);
		$datastore->vmfs = self::array2Object(array(
			'type' => $info->vmfs->type,
			'name' => $info->vmfs->name,
			'capacity' => $info->vmfs->capacity,
			'version' => $info->vmfs->version,
			'uuid' => $info->vmfs->uuid,
			'ssd' => $info->vmfs->ssd,
		));
		
		$datastore->setAPI($api);
		return $datastore;
	}

	public static function getPropertyByName(string $name, array $propset)
	{
		foreach($propset as $prop){
			if($prop->name == $name ){
				return $prop->val;
			}
		}
		return null;
	}

	public static function array2Object(array $array): DynamicData
	{
		$new = new DynamicData;
		foreach($array as $key => $value){
			if(is_array($value)){
				$value = self::array2Object($value);
			}
			$new->$key = $value;
		}
		return $new;
	}
}