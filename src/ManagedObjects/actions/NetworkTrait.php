<?php
namespace dnj\phpvmomi\ManagedObjects\actions;

use SoapVar;
use dnj\phpvmomi\API;
use dnj\phpvmomi\ManagedObjects\Network;
use dnj\phpvmomi\DataObjects\DynamicData;

trait NetworkTrait
{
	public function list()
	{
		try {

			$response = $this->api->getPropertyCollector()->_RetrievePropertiesEx(array(
				'propSet' => array(
					'type' => 'Network',
					'all' => false,
					'pathSet' => 'config.network.portgroup',
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
			));
		} catch (\Exception $e) {
			var_dump($e);
			die;
		}
		var_dump($response);
		die;
		if (!is_array($response)) {
			$response = [$response];
		}
		$datastores = [];
		foreach($response as $ds){
			$datastores[] = self::fromAPI($this->api, $ds);
		}
		return $datastores;
	}

	public static function fromAPI(API $api, DynamicData $response, ?Network $network = null): Network
	{

		if ($network == null) {
			$network = new self($api);
		}

		$network->id = $response->obj->_;
		$network->browser = self::getPropertyByName('browser', $response->propSet);
		$network->capability = self::getPropertyByName('capability', $response->propSet);
		$network->host = self::getPropertyByName('host', $response->propSet);
		$network->info = self::getPropertyByName('info', $response->propSet);
		$network->iormConfiguration = self::getPropertyByName('iormConfiguration', $response->propSet);
		$network->summary = self::getPropertyByName('summary', $response->propSet);
		$network->configStatus = self::getPropertyByName('configStatus', $response->propSet);
		$network->vm = self::getPropertyByName('vm', $response->propSet);
		
		$network->setAPI($api);
		return $network;
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