<?php
namespace DNJ\PHPVMOMI\ManagedObjects;

use DNJ\PHPVMOMI\DataObjects\Event;
use DNJ\PHPVMOMI\DataObjects\ManagedObjectReference;

/**
 * This managed object type provides a way to manage and manipulate files and folders on datastores. The source and the destination names are in the form of a URL or a datastore path.
 * A URL has the form
 *    scheme://authority/folder/path?dcPath=dcPath&dsName=dsName
 * where
 * scheme is http or https.
 * authority specifies the hostname or IP address of the VirtualCenter or ESX server and optionally the port.
 * dcPath is the inventory path to the Datacenter containing the Datastore.
 * dsName is the name of the Datastore.
 * path is a slash-delimited path from the root of the datastore.
 * A datastore path has the form
 *     [datastore] path
 * where
 * datastore is the datastore name.
 * path is a slash-delimited path from the root of the datastore.
 * An example datastore path is "[storage] path/to/file.extension". A listing of all the files, disks and folders on a datastore can be obtained from the datastore browser.
 * 
 * @todo complete methods
 *
 * @see HostDatastoreBrowser
 * @see https://vdc-download.vmware.com/vmwb-repository/dcr-public/b50dcbbf-051d-4204-a3e7-e1b618c1e384/538cf2ec-b34f-4bae-a332-3820ef9e7773/vim.FileManager.html
 */
class FileManager extends ManagedEntity
{
	use actions\NeedAPITrait;

	/**
	 * @var string $name
	 * @since vSphere API 4.0
	 */
	protected $name;

	/**
	 * @var ManagedObjectReference<Datacenter> $datacenter
	 * @since vSphere API 4.0
	 */
	protected $datacenter;

	/**
	 * @var string $owner;
	 * @since vSphere API 4.0
	 */
	protected $owner;

	public function _DeleteDatastoreFile_Task(string $name, $datacenter = null): Task
	{
		$params = array(
			"_this" => $this->api->getServiceContent()->fileManager,
			"name" => $name,
		);
		if ($datacenter) {
			$params['datacenter'] = $datacenter;
		}

		$response = $this->api->getClient()->DeleteDatastoreFile_Task($params);
		return $this->api->getTask()->byID($response->returnval->_);
	}
}
