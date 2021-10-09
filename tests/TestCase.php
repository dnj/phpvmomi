<?php

namespace dnj\phpvmomi\Tests;

use dnj\phpvmomi\API;

class TestCase extends \PHPUnit\Framework\TestCase
{
    protected ?API $api = null;

    public function getAPI(): ?API
    {
        if (!$this->api) {
            $sdk = $this->getApiSdkUrl();
            if (!$sdk) {
                $this->markTestSkipped('This test needs API');
            }
            $username = $this->getApiUsername();
            if (!$username) {
                throw new Exception('sdk url is provided but not username');
            }
            $password = $this->getApiPassword();
            if (!$password) {
                throw new Exception('sdk url is provided but not password');
            }
            $this->api = new API([
                'sdk' => $sdk,
                'username' => $username,
                'password' => $password,
                // 'connect-on-create' => false,
                // 'login-on-create' => false,
                'ssl_verify' => false,
            ]);
        }

        return $this->api;
    }

    public function getApiSdkUrl(): string
    {
        return getenv('PHPVOMI_API_URL') ?: '';
    }

    public function getApiUsername(): string
    {
        return getenv('PHPVOMI_API_USER') ?: '';
    }

    public function getApiPassword(): string
    {
        return getenv('PHPVOMI_API_PASS') ?: '';
    }

    public function getHostID(bool $required = true): string
    {
        $id = getenv('PHPVOMI_HOST_ID') ?: '';
        if (!$id and $required) {
            $this->markTestSkipped('This test needs Host ID');
        }

        return $id;
    }

    protected function getDatastoreID(bool $required = true): string
    {
        $id = getenv('PHPVOMI_DATASTORE_ID') ?: '';
        if (!$id and $required) {
            $this->markTestSkipped('This test needs Datastore ID');
        }

        return $id;
    }

    protected function getVmID(bool $required = true): string
    {
        $id = getenv('PHPVOMI_VM_ID') ?: '';
        if (!$id and $required) {
            $this->markTestSkipped('This test needs VM ID');
        }

        return $id;
    }

    protected function getVmTemplateIDID(bool $required = true): string
    {
        $id = getenv('PHPVOMI_VM_TEMPLATE_ID') ?: '';
        if (!$id and $required) {
            $this->markTestSkipped('This test needs VM Template ID');
        }

        return $id;
    }

    protected function getVMUsername(bool $required = true): string
    {
        $username = getenv('PHPVOMI_VM_GUEST_USERNAME') ?: '';
        if (!$username and $required) {
            $this->markTestSkipped('This test needs VM username and password');
        }

        return $username;
    }

    protected function getVMPassword(bool $required = true): string
    {
        $password = getenv('PHPVOMI_VM_GUEST_PASSWORD') ?: '';
        if (!$password and $required) {
            $this->markTestSkipped('This test needs VM username and password');
        }

        return $password;
    }
}
