<?php

namespace dnj\phpvmomi;

use dnj\phpvmomi\DataObjects\ManagedObjectReference;
use dnj\phpvmomi\DataObjects\ServiceContent;
use dnj\phpvmomi\Exceptions\MissingOptionException;
use dnj\phpvmomi\ManagedObjects\ManagedEntity;
use dnj\phpvmomi\ManagedObjects\PropertyCollector;
use dnj\phpvmomi\ManagedObjects\ServiceInstance;
use dnj\phpvmomi\ManagedObjects\SessionManager;
use dnj\phpvmomi\ManagedObjects\ViewManager;

/**
 * @method \dnj\phpvmomi\ManagedObjects\SessionManager         getSessionManager()
 * @method \dnj\phpvmomi\ManagedObjects\PropertyCollector      getPropertyCollector()
 * @method \dnj\phpvmomi\ManagedObjects\FileManager            getFileManager()
 * @method \dnj\phpvmomi\ManagedObjects\VirtualDiskManager     getVirtualDiskManager()
 * @method \dnj\phpvmomi\ManagedObjects\GuestOperationsManager getGuestOperationsManager()
 */
class API
{
    /**
     * @var array<string, mixed>
     */
    protected $options = [
        'sdk' => '',
        'datastore-browser' => '',
        'username' => '',
        'password' => '',
        'ssl_verify' => true,
        'timeout' => 180,
        'connect-on-create' => true,
        'login-on-create' => true,
    ];

    protected ?SoapClient $client = null;
    protected ?ServiceInstance $serviceInstance = null;
    protected array $managedObjectsCache = [];

    /**
     * @param array<string,mixed> $options
     */
    public function __construct(array $options)
    {
        $this->options = array_replace($this->options, $options);

        if (!$this->options['sdk']) {
            throw new MissingOptionException('sdk');
        }
        if (!$this->options['username']) {
            throw new MissingOptionException('username');
        }
        if (!$this->options['password']) {
            throw new MissingOptionException('password');
        }
        if ($this->options['connect-on-create']) {
            $this->connect();
        }
        if ($this->options['login-on-create']) {
            $this->login();
        }
    }

    /**
     * @param array<mixed> $arguments
     *
     * @return ManagedEntity
     */
    public function __call(string $name, array $arguments)
    {
        if (strlen($name) <= 3 or 'get' != substr($name, 0, 3)) {
            throw new Exception('Call to undefined method '.__CLASS__."::{$name}");
        }
        $className = substr($name, 3);
        $property = lcfirst($className);
        $content = $this->getServiceContent();
        if (!isset($content->{$property})) {
            throw new Exception('Call to undefined method '.__CLASS__."::{$name}");
        }
        $result = $content->{$property};

        if ($result instanceof ManagedObjectReference) {
            $result = $result->get($this);
        }

        return $result;
    }

    /**
     * Get a value of an options or all of the options.
     *
     * @param string|null $name that is the name of the options or null to get all of options
     *
     * @return array|mixed|null
     */
    public function getOption(?string $name = null)
    {
        return $name ? ($this->options[$name] ?? null) : $this->options;
    }

    public function getClient(): SoapClient
    {
        if (!$this->client) {
            $this->connect();
        }

        return $this->client;
    }

    public function connect(): void
    {
        $params = [
            'encoding' => 'UTF-8',
            'trace' => 1,
            'exceptions' => 1,
            'cache_wsdl' => WSDL_CACHE_BOTH,
            'location' => $this->options['sdk'],
        ];
        if (!$this->options['ssl_verify']) {
            $params['stream_context'] = stream_context_create([
                'ssl' => [
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true,
                ],
            ]);
        }
        if ($this->options['timeout']) {
            $params['connection_timeout'] = $this->options['timeout'];
        }
        $params['classmap'] = array_merge(
            ClassMap\ManagedObjectsClassMap::CLASS_MAP,
            ClassMap\DataObjectsClassMap::CLASS_MAP,
            ClassMap\FaultsClassMap::CLASS_MAP
        );

        $this->client = new SoapClient(
            $this->options['sdk'].'vimService.wsdl',
            $params
        );
    }

    public function login(): void
    {
        $this->getSessionManager()->_Login(
            $this->options['username'],
            $this->options['password']
        );
    }

    public function getServiceInstance(): ServiceInstance
    {
        if (!$this->serviceInstance) {
            $this->serviceInstance = new ServiceInstance($this);
        }

        return $this->serviceInstance;
    }

    public function getServiceContent(): ServiceContent
    {
        $content = $this->getServiceInstance()->content;
        if (!$content) {
            $this->serviceInstance->content = $content = $this->serviceInstance->_RetrieveServiceContent();
            $this->prepareManagedObjectsCache();
        }

        return $content;
    }

    public function isInited(): bool
    {
        return null !== $this->serviceInstance;
    }

    /**
     * @return "VirtualCenter"|"HostAgent"
     */
    public function getApiType(): string
    {
        return $this->getServiceContent()->about->apiType;
    }

    public function getManagedObjectCache(string $type, string $id): ?ManagedEntity
    {
        return $this->managedObjectsCache[$type.'-'.$id] ?? null;
    }

    public function addToManagedObjectCache(?ManagedEntity $obj, ?string $type = null, ?string $id = null): void
    {
        if (null === $obj and (null === $type or null === $id)) {
            throw new Exception('need type and id for deleting from cache');
        }
        if (!$type) {
            $type = $obj->type();
        }
        if (!$id) {
            $id = $obj->id;
        }
        $this->managedObjectsCache[$type.'-'.$id] = $obj;
    }

    protected function prepareManagedObjectsCache(): void
    {
        foreach ([PropertyCollector::class, SessionManager::class, ViewManager::class] as $class) {
            $name = substr($class, strrpos($class, '\\') + 1);
            $property = lcfirst($name);
            if (isset($this->serviceInstance->content->{$property})) {
                $obj = new $class($this);
                $obj->id = $this->serviceInstance->content->{$property}->_;
                $this->addToManagedObjectCache($obj);
            }
        }
    }
}
