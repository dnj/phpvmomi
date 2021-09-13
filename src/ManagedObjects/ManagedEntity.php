<?php
namespace dnj\phpvmomi\ManagedObjects;

use dnj\phpvmomi\DataObjects\Event;

/**
 * ManagedEntity is an abstract base type for all managed objects present in the inventory tree.
 * The base type provides common functionality for traversing the tree structure, as well as health monitoring and other basic functions.
 * Most Virtual Infrastructure managed object types extend this type.
 *
 * @todo complete properties
 * @see https://vdc-download.vmware.com/vmwb-repository/dcr-public/b50dcbbf-051d-4204-a3e7-e1b618c1e384/538cf2ec-b34f-4bae-a332-3820ef9e7773/vim.ManagedEntity.html
 */
class ManagedEntity extends ExtensibleManagedObject
{
	use actions\NeedAPITrait;

	/**
	 * @var bool $alarmActionsEnabled Whether alarm actions are enabled for this entity. True if enabled; false otherwise.
	 */
	public $alarmActionsEnabled;

	/**
	 * @var Event[] $configIssue Current configuration issues that have been detected for this entity.
	 * 								Typically, these issues have already been logged as events.
	 * 								The entity stores these events as long as they are still current.
	 * 								The ConfigStatus property provides an overall status based on these events. 
	 */
	public $configIssue;

	/**
	 * @var string $name Name of this entity, unique relative to its parent.
	 * Any / (slash), \ (backslash), character used in this name element will be escaped. Similarly, any % (percent) character used in this name element will be escaped, unless it is used to start an escape sequence. A slash is escaped as %2F or %2f. A backslash is escaped as %5C or %5c, and a percent is escaped as %25. 
	 */
	public $name;

	/**
	 * @param array{type: string, _:int} $_this
	 */
	public function _Destroy_Task(array $_this): Task
	{
		$response = $this->api->getClient()->Destroy_Task(array(
			'_this' => $_this,
		));
		return $this->api->getTask()->byID($response->returnval->_);
	}
}
