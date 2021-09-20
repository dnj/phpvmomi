<?php
namespace dnj\phpvmomi\ManagedObjects;

use SoapFault;
use SoapVar;
use dnj\phpvmomi\Faults\InvalidLoginFault;
use dnj\phpvmomi\Faults\InvalidLocaleFault;
use dnj\phpvmomi\DataObjects\UserSession;

/**
 * @todo implement
 * @see https://vdc-download.vmware.com/vmwb-repository/dcr-public/b50dcbbf-051d-4204-a3e7-e1b618c1e384/538cf2ec-b34f-4bae-a332-3820ef9e7773/vim.view.ViewManager.html
 */
class ViewManager
{
	use actions\NeedAPITrait;

	/**
	 * @var ManagedObjectReference $_this
	 */
	public $_this;

	/**
	 * @var ManagedEntity $container
	 */
	public $container;

	/**
	 * @var string $type
	 */
	public $type;

	/**
	 * @var bool $recursive
	 */
	public $recursive;

	public function _CreateContainerView(SoapVar $_this = null, ManagedEntity $container = null, string $type = null, bool $recursive = true)
	{
		$params = [
			'_this' => $_this ?? new SoapVar('ViewManager', XSD_STRING, 'ViewManager'),
			'container' => ($container ? $container::TYPE : null) ?? $this->api->getServiceContent()->rootFolder,
			'type' => $type ?? HostSystem::TYPE,
			'recursive' => $recursive,
		];
		return $this->api->getClient()->CreateContainerView($params)->returnval;
	}

}