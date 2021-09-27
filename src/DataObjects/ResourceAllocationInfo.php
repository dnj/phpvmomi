<?php

namespace dnj\phpvmomi\DataObjects;

/**
 * @todo recheck
 */
class ResourceAllocationInfo extends DynamicData
{
    /** @var int */
    public $reservation;

    /** @var bool */
    public $expandableReservation;

    /** @var int */
    public $limit;

    /** @var SharesInfo */
    public $shares;

    /** @var int */
    public $overheadLimit;
}
