<?php

namespace dnj\phpvmomi\ManagedObjects\actions;

use dnj\phpvmomi\DataObjects\ManagedObjectReference;
use dnj\phpvmomi\ManagedObjects\HostSystem;
use dnj\phpvmomi\ManagedObjects\Network;
use SoapFault;
use SoapVar;

trait NetworkTrait
{
    /**
     * @return ManagedObjectReference<Network>[]
     */
    public function list(): array
    {
        $response = null;
        try {
            $viewManager = $this->api->getViewManager();
            $containerView = $viewManager->_CreateContainerView();

            $response = $this->api->getPropertyCollector()->_RetrieveProperties([
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
        } catch (SoapFault $e) {
            throw $e;
        }
        $result = $response->returnval;

        return $result->propSet->val->ManagedObjectReference;
    }
}
