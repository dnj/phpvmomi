<?php

namespace dnj\phpvmomi\ManagedObjects\Custom;

use dnj\phpvmomi\API;
use dnj\phpvmomi\ManagedObjects\actions\NeedAPITrait;
use dnj\phpvmomi\ManagedObjects\Datastore;
use dnj\phpvmomi\ManagedObjects\Task;
use SplFileObject;

class File
{
    use NeedAPITrait;

    protected $datastore;
    protected $path;

    public function __construct(API $api, Datastore $datastore, string $path)
    {
        $this->api = $api;
        $this->datastore = $datastore;
        $this->setPath($path);
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function getDatastore(): Datastore
    {
        return $this->datastore;
    }

    public function getURL(): string
    {
        return $this->datastore->url.'/'.$this->path;
    }

    public function __toString(): string
    {
        return '['.$this->datastore->vmfs->name.'] '.$this->path;
    }

    public function __get(string $key)
    {
        if (in_array($key, ['datastore', 'path'])) {
            return $this->$key;
        } elseif ('url' == $key) {
            return $this->getURL();
        }

        return null;
    }

    public function delete(): Task
    {
        return $this->api->getFileManager()->_DeleteDatastoreFile_Task($this->__toString());
    }

    public function upload(SplFileObject $file)
    {
        $cookies = '';
        foreach ($this->api->getClient()->__getCookies() as $key => $params) {
            $cookies .= "{$key}={$params[0]};";
        }

        $url = $this->api->getOption('datastore-browser');
        if ('/' != substr($url, -1)) {
            $url .= '/';
        }

        $datacenter = $this->datastore->getDatacenter();
        $query = http_build_query([
            'dcPath' => $datacenter->name,
            'dsName' => $this->datastore->name,
        ]);

        $sslVerify = $this->api->getOption('ssl_verify');

        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_CUSTOMREQUEST => 'PUT',
            CURLOPT_URL => $url.$this->path.'?'.$query,
            CURLOPT_BINARYTRANSFER => true,
            CURLOPT_CONNECTTIMEOUT => 2,
            CURLOPT_HTTPHEADER => [
                'cookie' => $cookies,
                'content-type' => 'application/octet-stream',
            ],
            CURLOPT_COOKIE => $cookies,
            CURLOPT_UPLOAD => true,
            CURLOPT_INFILE => fopen($file->getRealPath(), 'r'),
            CURLOPT_INFILESIZE => $file->getSize(),
            CURLOPT_SSL_VERIFYPEER => $sslVerify,
            CURLOPT_SSL_VERIFYHOST => $sslVerify ? 2 : 0,
        ]);
        $result = curl_exec($curl);
        curl_close($curl);

        return false !== $result;
    }

    private function setPath(string $path): void
    {
        while ('/' == substr($path, 0, 1)) {
            $path = substr($path, 1);
        }
        $this->path = $path;
    }
}
