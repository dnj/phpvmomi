<?php

namespace dnj\phpvmomi\DataObjects;

/**
 * @see https://vdc-download.vmware.com/vmwb-repository/dcr-public/b50dcbbf-051d-4204-a3e7-e1b618c1e384/538cf2ec-b34f-4bae-a332-3820ef9e7773/vim.UserSession.html
 */
class UserSession extends DynamicData
{
    /**
     * @var int Number of API invocations since the session started
     */
    public $callCount;

    /**
     * @var bool whether or not this session belongs to a VC Extension
     */
    public $extensionSession;

    /**
     * @var string the full name of the user, if available
     */
    public $fullName;

    /**
     * @var string The client identity. It could be IP address, or pipe name depended on client binding
     */
    public $ipAddress;

    /**
     * @var string a unique identifier for this session, also known as the session ID
     */
    public $key;

    /**
     * @var string timestamp when the user last executed a command
     */
    public $lastActiveTime;

    /**
     * @var string the locale for the session used for data formatting and preferred for messages
     */
    public $locale;

    /**
     * @var string timestamp when the user last logged on to the server
     */
    public $loginTime;

    /**
     * @var string The locale used for messages for the session. If there are no localized messages for the user-specified locale, then the server determines this locale.
     */
    public $messageLocale;

    /**
     * @var string The name of user agent or application
     */
    public $userAgent;

    /**
     * @var string the user name represented by this session
     */
    public $userName;
}
