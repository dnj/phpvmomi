<?php

namespace dnj\phpvmomi\DataObjects;

/**
 * @see https://vdc-download.vmware.com/vmwb-repository/dcr-public/b50dcbbf-051d-4204-a3e7-e1b618c1e384/538cf2ec-b34f-4bae-a332-3820ef9e7773/vim.vm.guest.NamePasswordAuthentication.html
 */
class NamePasswordAuthentication extends GuestAuthentication
{
    public string $username;
    public string $password;

    public function __construct(string $username, string $password, bool $interactiveSession)
    {
        parent::__construct($interactiveSession);
        $this->username = $username;
        $this->password = $password;
    }
}
