<?php
namespace dnj\phpvmomi\DataObjects;

/**
 * @todo recheck
 */
class StorageIOAllocationInfo extends DynamicData
{
	/** @var int $limit */
	public $limit;

	/** @var SharesInfo $shares */
	public $shares;
}