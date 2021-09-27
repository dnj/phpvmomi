<?php

namespace dnj\phpvmomi\DataObjects;

/**
 * @todo recheck
 */
class StorageIOAllocationInfo extends DynamicData
{
    /** @var int */
    public $limit;

    /** @var SharesInfo */
    public $shares;
}
