<?php

namespace dnj\phpvmomi\ManagedObjects;

use dnj\phpvmomi\DataObjects\UserSession;
use dnj\phpvmomi\Faults\InvalidLocaleFault;
use dnj\phpvmomi\Faults\InvalidLoginFault;
use SoapFault;

/**
 * @todo implement
 *
 * @see https://vdc-download.vmware.com/vmwb-repository/dcr-public/b50dcbbf-051d-4204-a3e7-e1b618c1e384/538cf2ec-b34f-4bae-a332-3820ef9e7773/vim.SessionManager.html#login
 */
class SessionManager
{
    use actions\NeedAPITrait;

    public function _Login(string $userName, string $password, ?string $locale = null): UserSession
    {
        $params = [
            '_this' => $this->api->getServiceContent()->sessionManager,
            'userName' => $userName,
            'password' => $password,
        ];
        if ($locale) {
            $params['locale'] = $locale;
        }
        try {
            return $this->api->getClient()->Login($params)->returnval;
        } catch (SoapFault $e) {
            if ('Cannot complete login due to an incorrect user name or password.' == $e->getMessage()) {
                throw new InvalidLoginFault();
            }
            if ('Invalid or unknown locale provided.' == $e->getMessage()) {
                throw new InvalidLocaleFault();
            }
            throw $e;
        }
    }
}
