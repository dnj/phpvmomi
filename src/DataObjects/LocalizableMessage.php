<?php

namespace dnj\phpvmomi\DataObjects;

/**
 * @see hhttps://vdc-download.vmware.com/vmwb-repository/dcr-public/b50dcbbf-051d-4204-a3e7-e1b618c1e384/538cf2ec-b34f-4bae-a332-3820ef9e7773/vmodl.LocalizableMessage.html
 */
class LocalizableMessage extends DynamicData
{
    /**
     * @var KeyAnyValue[]
     */
    public $arg;

    /**
     * @var string unique key identifying the message in the localized message catalog
     */
    public $key;

    /**
     * @var string Message in session locale. Use vim.SessionManager.setLocale() to change the session locale.
     */
    public $message;
}
