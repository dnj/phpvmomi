<?php

namespace dnj\phpvmomi\DataObjects;

/**
 * Basic host statistics.
 * Included in the host statistics are fairness scores.
 * Fairness scores are represented in units with relative values, meaning they are evaluated relative to the scores of other hosts.
 * They should not be thought of as having any particular absolute value.
 * Each fairness unit represents an increment of 0.001 in a fairness score.
 * The further the fairness score diverges from 1, the less fair the allocation.
 * Therefore, a fairness score of 990, representing 0.990, is more fair than a fairness score of 1015, which represents 1.015.
 * This is because 1.015 is further from 1 than 0.990.
 *
 * @see https://vdc-download.vmware.com/vmwb-repository/dcr-public/b50dcbbf-051d-4204-a3e7-e1b618c1e384/538cf2ec-b34f-4bae-a332-3820ef9e7773/vim.host.Summary.QuickStats.html
 */
class HostListSummaryQuickStats extends DynamicData
{
    /**
     * @var int the available capacity in MB
     */
    public $availablePMemCapacity;

    /**
     * @var int the fairness of distributed CPU resource allocation on the host
     */
    public $distributedCpuFairness;

    /**
     * @var int the fairness of distributed memory resource allocation on the host
     */
    public $distributedMemoryFairness;

    /**
     * @var int Aggregated CPU usage across all cores on the host in MHz. This is only available if the host is connected.
     */
    public $overallCpuUsage;

    /**
     * @var int Physical memory usage on the host in MB. This is only available if the host is connected.
     */
    public $overallMemoryUsage;

    /**
     * @var int the system uptime of the host in seconds
     */
    public $uptime;
}
