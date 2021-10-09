<?php

namespace dnj\phpvmomi\ManagedObjects;

use dnj\phpvmomi\DataObjects\Capability;
use dnj\phpvmomi\DataObjects\ServiceContent;

/**
 * @see https://vdc-download.vmware.com/vmwb-repository/dcr-public/b50dcbbf-051d-4204-a3e7-e1b618c1e384/538cf2ec-b34f-4bae-a332-3820ef9e7773/vim.ServiceInstance.html#retrieveContent
 */
class ServiceInstance extends ManagedEntity
{
    public ?string $id = 'ServiceInstance';

    /**
     * @var Capability API-wide capabilities
     */
    public $capability;

    /**
     * @var ServiceContent The properties of the ServiceInstance managed object.
     *                     The content property is identical to the return value from the RetrieveServiceContent method.
     *                     Use the content property with the PropertyCollector to perform inventory traversal that includes the ServiceInstance.
     *                     (In the absence of a content property, a traversal that encounters the ServiceInstance would require calling the RetrieveServiceContent method, and then invoking a second traversal to continue.)
     */
    public $content;

    /**
     * @var string Contains the time most recently obtained from the server. The time is not necessarily current. This property is intended for use with the PropertyCollector WaitForUpdates method. The PropertyCollector will provide notification if some event occurs that changes the server clock time in a non-linear fashion.
     *             You should not rely on the serverClock property to get the current time on the server; instead, use the CurrentTime method.
     */
    public $serverClock;

    public function _RetrieveServiceContent(): ServiceContent
    {
        return $this->api->getClient()->RetrieveServiceContent([
            '_this' => $this->ref(),
        ])->returnval;
    }
}
