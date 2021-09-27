<?php

namespace dnj\phpvmomi\ManagedObjects;

/**
 * Represents a storage location for virtual machine files. A storage location can be a VMFS volume, a directory on Network Attached Storage, or a local file system path.
 * A datastore is platform-independent and host-independent. Therefore, datastores do not change when the virtual machines they contain are moved between hosts.
 * The scope of a datastore is a datacenter; the datastore is uniquely named within the datacenter.
 * Any reference to a virtual machine or file accessed by any host within the datacenter must use a datastore path.
 * A datastore path has the form "[<datastore>] <path>", where <datastore> is the datastore name, and <path> is a slash-delimited path from the root of the datastore.
 * An example datastore path is "[storage] path/to/config.vmx".
 * You may use the following characters in a path, but not in a datastore name: slash (/), backslash (\), and percent (%).
 * All references to files in the VIM API are implicitly done using datastore paths.
 * When a client creates a virtual machine, it may specify the name of the datastore, omitting the path; the system, meaning VirtualCenter or the host, automatically assigns filenames and creates directories on the given datastore.
 * For example, specifying My_Datastore as a location for a virtual machine called MyVm results in a datastore location of My_Datastore\MyVm\MyVm.vmx.
 * Datastores are configured per host. As part of host configuration, a HostSystem can be configured to mount a set of network drives. Multiple hosts may be configured to point to the same storage location.
 * There exists only one Datastore object per Datacenter, for each such shared location. Each Datastore object keeps a reference to the set of hosts that have mounted the datastore.
 * A Datastore object can be removed only if no hosts currently have the datastore mounted.
 * Thus, managing datastores is done both at the host level and the datacenter level. Each host is configured explicitly with the set of datastores it can access. At the datacenter, a view of the datastores across the datacenter is shown.
 *
 * @see https://vdc-download.vmware.com/vmwb-repository/dcr-public/b50dcbbf-051d-4204-a3e7-e1b618c1e384/538cf2ec-b34f-4bae-a332-3820ef9e7773/vim.Datastore.html
 */
class Datastore extends ManagedEntity
{
    use actions\DatastoreTrait;

    /**
     * @var HostDatastoreBrowser
     */
    public $browser;

    /**
     * @var DatastoreCapability
     */
    public $capability;

    /**
     * @var DatastoreHostMount[]
     */
    public $host;

    /**
     * @var \stdClass
     */
    public $info;

    /**
     * @var iormConfiguration
     */
    public $iormConfiguration;

    /**
     * @var DatastoreSummary
     */
    public $summary;

    /**
     * @var VirtualMachine[]
     */
    public $vm;
}
