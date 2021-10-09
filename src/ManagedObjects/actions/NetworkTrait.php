<?php

namespace dnj\phpvmomi\ManagedObjects\actions;

use dnj\phpvmomi\DataObjects\ManagedObjectReference;
use dnj\phpvmomi\ManagedObjects\HostSystem;
use dnj\phpvmomi\ManagedObjects\Network;
use SoapVar;

trait NetworkTrait
{
    /**
     * @return ManagedObjectReference<Network>[]
     */
    public function list(): array
    {
        $response = null;
        $viewManager = $this->api->getViewManager();
        $containerView = $viewManager->_CreateContainerView();

        $result = $this->api->getPropertyCollector()->_RetrieveProperties([
            'propSet' => [
                'type' => HostSystem::TYPE,
                'all' => false,
                'pathSet' => 'network',
            ],
            'objectSet' => [
                'obj' => $containerView,
                'skip' => true,
                'selectSet' => [
                    new SoapVar(
                        [
                            'name' => 'view',
                            'type' => 'ContainerView',
                            'path' => 'view',
                            'skip' => false,
                        ],
                        SOAP_ENC_OBJECT,
                        'TraversalSpec'
                    ),
                ],
            ],
        ]);

        return $result->propSet->val->ManagedObjectReference;
    }
}
