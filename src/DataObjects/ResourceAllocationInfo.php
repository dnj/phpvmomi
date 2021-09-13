<?php
namespace dnj\phpvmomi\DataObjects;

/**
 * @todo recheck
 */
class ResourceAllocationInfo extends DynamicData
{

	/** @var int $reservation */
	public $reservation;

	/** @var bool $expandableReservation */
	public $expandableReservation;

	/** @var int $limit */
	public $limit;

	/** @var SharesInfo $shares */
	public $shares;

	/** @var int $overheadLimit */
	public $overheadLimit;
}