<?php
namespace dnj\phpvmomi\ManagedObjects\actions;

use SoapVar;
use SoapFault;
use dnj\phpvmomi\API;
use dnj\phpvmomi\ManagedObjects\HostSystem;
use dnj\phpvmomi\DataObjects\HostPortGroup;

trait HostSystemTrait
{
	public function byID(string $id): HostSystem
	{
		$result = $this->api->getPropertyCollector()->_RetrieveProperties(array(
			'propSet' => array(
				'type' => 'HostSystem',
				'all' => true,
			),
			'objectSet' => array(
				'obj' => array(
					'type' => 'HostSystem',
					'_' => $id
				),
				'skip' => false
			)
		));
		return $this->frompropertyCollector($this->api, $result->returnval);
	}

	public function getHostListSummary()
	{
		$response = null;
		try {
			$viewManager = $this->api->getViewManager();
			$containerView = $viewManager->_CreateContainerView();

			$response = $this->api->getPropertyCollector()->_RetrieveProperties(array(
				'propSet' => [
					'type' => HostSystem::TYPE,
					'all' => false,
					'pathSet' => 'summary',
				],
				'objectSet' => [
					'obj' => $containerView,
					'skip' => true,
					'selectSet' => [
						new SoapVar(
							array(
								'name' => 'view',
								'type' => 'ContainerView',
								'path' => 'view',
								'skip' => false,
							),
							SOAP_ENC_OBJECT,
							'TraversalSpec'
						),
					]
				],
			));
		} catch (SoapFault $e) {
			throw $e;
		}
		$result = $response->returnval;
		return $result->propSet->val;
	}

	/**
	 * @return HostPortGroup[]
	 */
	public function getHostPortGroups(): array
	{
		$response = null;
		try {
			$viewManager = $this->api->getViewManager();
			$containerView = $viewManager->_CreateContainerView();

			$response = $this->api->getPropertyCollector()->_RetrieveProperties(array(
				'propSet' => [
					'type' => HostSystem::TYPE,
					'all' => false,
					'pathSet' => 'config.network.portgroup',
				],
				'objectSet' => [
					'obj' => $containerView,
					'skip' => true,
					'selectSet' => [
						new SoapVar(
							array(
								'name' => 'view',
								'type' => 'ContainerView',
								'path' => 'view',
								'skip' => false,
							),
							SOAP_ENC_OBJECT,
							'TraversalSpec'
						),
					]
				],
			));
		} catch (SoapFault $e) {
			throw $e;
		}
		$result = $response->returnval;
		return $result->propSet->val->HostPortGroup;
	}

	protected static function fromPropertyCollector(API $api, $response): HostSystem
	{
		$obj = new HostSystem($api);
		$obj->id = $response->obj->_;
		foreach ($response->propSet as $prop) {
			$obj->{$prop->name} = $prop->val;
		}
		return $obj;
	}
}