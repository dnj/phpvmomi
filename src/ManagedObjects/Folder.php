<?php

namespace dnj\phpvmomi\ManagedObjects;

/**
 * @todo complete methods
 *
 * @see https://vdc-download.vmware.com/vmwb-repository/dcr-public/b50dcbbf-051d-4204-a3e7-e1b618c1e384/538cf2ec-b34f-4bae-a332-3820ef9e7773/vim.Folder.html
 */
class Folder extends ManagedEntity
{
    use actions\NeedAPITrait;

    public const TYPE = 'Folder';

    /**
     * @var ManagedEntity[] An array of managed object references. Each entry is a reference to a child entity.
     */
    public $childEntity;

    /**
     * @var string[] Specifies the object types a folder may contain. When you create a folder, it inherits its childType from the parent folder in which it is created. childType is an array of strings. Each array entry identifies a set of object types - Folder and one or more managed object types.
     */
    public $childType;

    /**
     * @var string The namespace with which the Folder is associated. Namespace is a vAPI resource which divides cluster resources and allows administrators to give Kubernetes environments to their development teams. This property is set only at the time of creation and cannot change.
     *
     * @since vSphere API 7.0
     */
    public $namespace;

    public function _CreateVM_Task($config, $pool, $host = null): Task
    {
        $params = [
            '_this' => [
                'type' => self::TYPE,
                '_' => 'ha-folder-vm',
            ],
            'config' => $config,
            'pool' => $pool,
        ];
        if ($host) {
            $params['host'] = $host;
        }
        $response = $this->api->getClient()->CreateVM_Task($params);

        return $this->api->getTask()->byID($response->returnval->_);
    }
}
