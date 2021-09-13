<?php
namespace dnj\phpvmomi\ManagedObjects\actions;

use SoapVar;
use dnj\phpvmomi\API;
use dnj\phpvmomi\ManagedObjects\Datastore;
use dnj\phpvmomi\DataObjects\DynamicData;

trait DatastoreTrait
{
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

	public static function fromAPI(API $api, DynamicData $response, ?Datastore $datastore = null):Datastore{

		if ($datastore == null) {
			$datastore = new self($api);
		}

		$datastore->id = $response->obj->_;
		$datastore->browser = self::getPropertyByName('browser', $response->propSet);
		$datastore->capability = self::getPropertyByName('capability', $response->propSet);
		$datastore->host = self::getPropertyByName('host', $response->propSet);
		$datastore->info = self::getPropertyByName('info', $response->propSet);
		$datastore->iormConfiguration = self::getPropertyByName('iormConfiguration', $response->propSet);
		$datastore->summary = self::getPropertyByName('summary', $response->propSet);
		$datastore->configStatus = self::getPropertyByName('configStatus', $response->propSet);
		$datastore->vm = self::getPropertyByName('vm', $response->propSet);
		
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