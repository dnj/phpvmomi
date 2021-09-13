<?php
namespace dnj\phpvmomi;

use dnj\phpvmomi\SoapClient;
use SoapFault;
use dnj\phpvmomi\DataObjects\ServiceContent;
use dnj\phpvmomi\ManagedObjects\ServiceInstance;
use dnj\phpvmomi\ManagedObjects\ExtensibleManagedObject;
use dnj\phpvmomi\Exceptions\MissingOptionException;

/**
 * @method getTask()
 * @method getSessionManager()
 * @method getServiceInstance()
 * @method getPropertyCollector()
 * @method getVirtualMachine()
 * @method getFileManager()
 */
class API
{
	/**
	 * @var array<string, mixed> $options
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

	protected ?ServiceContent $serviceContent = null;

	/**
	 * @param array<string, mixed> $options
	 */
	public function __construct(array $options) {
		$this->options = array_replace($this->options, $options);

		if (!$this->options['sdk']) {
			throw new MissingOptionException('sdk');
		}
		if (!$this->options['datastore-browser']) {
			throw new MissingOptionException('datastore-browser');
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
	 * @param string $name
	 * @param array<mixed> $arguments
	 * @return ExtensibleManagedObject|ServiceInstance
	 */
	public function __call(string $name, array $arguments)
	{
		if (strlen($name) <= 3 or
			substr($name, 0, 3) != 'get' or
			!array_key_exists(substr($name, 3), ClassMap\ManagedObjectsClassMap::CLASS_MAP)
		) {
			trigger_error("Call to undefined method " . __CLASS__ . "::{$name}", E_USER_ERROR);
		}
		$className = substr($name, 3);
		$classString = ClassMap\ManagedObjectsClassMap::CLASS_MAP[$className];
		return new $classString($this);
	}

	/**
	 * Get a value of an options or all of the options
	 *
	 * @param string|null $name that is the name of the options or null to get all of options
	 * @return array|mixed|null
	 */
	public function getOption(?string $name = null) {
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
			'cache_wsdl'=> WSDL_CACHE_BOTH,
			'location' => $this->options['sdk'],
		];
		if (!$this->options['ssl_verify']) {
			$params['stream_context'] = stream_context_create([
				'ssl' => [
					'verify_peer' => false,
					'verify_peer_name' => false,
					'allow_self_signed' => true
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
			$this->options['sdk'] . 'vimService.wsdl',
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

	public function getServiceContent(): ServiceContent
	{
		if ($this->serviceContent) {
			return $this->serviceContent;
		}
		try {
			return $this->serviceContent = $this->getServiceInstance()->_RetrieveServiceContent();
		} catch (SoapFault $e) {
			var_dump($e);
			throw $e;
		}
	}
}