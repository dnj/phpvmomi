<?php
namespace DNJ\PHPVMOMI\ManagedObjects;

use SoapFault;
use DNJ\PHPVMOMI\Faults\InvalidLoginFault;
use DNJ\PHPVMOMI\Faults\InvalidLocaleFault;
use DNJ\PHPVMOMI\DataObjects\UserSession;

/**
 * @todo implement
 * @see https://vdc-download.vmware.com/vmwb-repository/dcr-public/b50dcbbf-051d-4204-a3e7-e1b618c1e384/538cf2ec-b34f-4bae-a332-3820ef9e7773/vim.SessionManager.html#login
 */
class SessionManager
{
	use actions\NeedAPITrait;

	public function _Login(string $userName, string $password, ?string $locale = null): UserSession
	{
		$params = array(
			'_this' => $this->api->getServiceContent()->sessionManager,
			'userName' => $userName,
			'password' => $password,
		);
		if ($locale) {
			$params['locale'] = $locale;
		}
		try{
			return $this->api->getClient()->Login($params)->returnval;
		} catch(SoapFault $e) {
			if ($e->getMessage() == 'Cannot complete login due to an incorrect user name or password.') {
				throw new InvalidLoginFault();
			}
			if ($e->getMessage() == 'Invalid or unknown locale provided.') {
				throw new InvalidLocaleFault();
			}
			throw $e;
		}
	}
}
