<?php

namespace dnj\phpvmomi\DataObjects;

/**
 * This event is the base data object type from which all events inherit. All event objects are data structures that describe events.
 * While event data objects are data structures that describe events, event data type documentation may describe what the event records, rather than the data structure, itself.
 *
 * @see https://vdc-download.vmware.com/vmwb-repository/dcr-public/b50dcbbf-051d-4204-a3e7-e1b618c1e384/538cf2ec-b34f-4bae-a332-3820ef9e7773/vim.event.Event.html
 */
class Event extends DynamicData
{
    /**
     * @var int the parent or group ID
     */
    public $chainId;

    /**
     * @var string The user entered tag to identify the operations and their side effects
     */
    public $changeTag;

    /**
     * @var ComputeResourceEventArgument the ComputeResource object of the event
     */
    public $computeResource;

    /**
     * @var string the time the event was created
     */
    public $createdTime;

    /**
     * @var DatacenterEventArgument the Datacenter object of the event
     */
    public $datacenter;

    /**
     * @var DatastoreEventArgument the Datastore object of the event
     *
     * @since vSphere API 4.0
     */
    public $ds;

    /**
     * @var DvsEventArgument the DistributedVirtualSwitch object of the event
     *
     * @since vSphere API 4.0
     */
    public $dvs;

    /**
     * @var string A formatted text message describing the event. The message may be localized.
     */
    public $fullFormattedMessage;

    /**
     * @var HostEventArgument the Host object of the event
     */
    public $host;

    /**
     * @var int the event ID
     */
    public $key;

    /**
     * @var NetworkEventArgument the Network object of the event
     *
     * @since vSphere API 4.0
     */
    public $net;

    /**
     * @var string the user who caused the event
     */
    public $userName;

    /**
     * @var VmEventArgument the VirtualMachine object of the event
     */
    public $vm;
}
