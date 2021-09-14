<?php
namespace dnj\phpvmomi\ManagedObjects\actions;

use SoapVar;
use SoapFault;
use dnj\phpvmomi\ManagedObjects\HostSystem;
use dnj\phpvmomi\DataObjects\HostPortGroup;

trait HostSystemTrait
{
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
}