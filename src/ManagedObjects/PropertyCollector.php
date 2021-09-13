<?php
namespace dnj\phpvmomi\ManagedObjects;

use SoapFault;
use dnj\phpvmomi\DataObjects\ManagedObjectReference;

/**
 * @todo complete methoda and properties
 * @see https://vdc-download.vmware.com/vmwb-repository/dcr-public/b50dcbbf-051d-4204-a3e7-e1b618c1e384/538cf2ec-b34f-4bae-a332-3820ef9e7773/vim.Datastore.html
 */
class PropertyCollector
{
	use actions\NeedAPITrait;

	/**
	 * @var ManagedObjectReference[]<PropertyFilter[]> $filter
	 */
	public $filter;

	public function _RetrieveProperties($specSet)
	{
		try {
			return $this->api->getClient()->RetrieveProperties(array(
				'_this' => $this->api->getServiceContent()->propertyCollector,
				'specSet' => $specSet,
			));
		} catch (SoapFault $e) {
			throw $e;
		}
	}

	public function _RetrievePropertiesEx($specSet, $options = null)
	{
		$params = array(
			'_this' => $this->api->getServiceContent()->propertyCollector,
			'specSet' => $specSet,
		);
		if ($options) {
			$params['options'] = $options;
		}
		try {
			return $this->api->getClient()->RetrieveProperties($params);
		} catch (SoapFault $e) {
			throw $e;
		}
	}
}
