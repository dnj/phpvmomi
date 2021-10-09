<?php

namespace dnj\phpvmomi\Utils;

use dnj\phpvmomi\API;
use dnj\phpvmomi\Exception;

class Path
{
    public static function fromDSPath(string $dsPath): self
    {
        if (!preg_match("/^\[(.*)\]\s+(.*)$/", $dsPath, $matches)) {
            throw new Exception('Invalid path');
        }

        return new self($matches[1], $matches[2]);
    }

    public static function fromURL(string $url): self
    {
        if (!preg_match("/^https?:\/\/.*/", $url)) {
            throw new Exception('Invalid url');
        }
        $components = parse_url($url);
        $host = "{$components['scheme']}://{$components['host']}";
        $path = $components['path'];
        if ('/folder/' != substr($path, 0, strlen('/folder/'))) {
            throw new Exception('invalid path');
        }
        $path = substr($path, strlen('/folder/'));
        parse_str($components['query'], $query);
        if (!isset($query['dcPath']) or !$query['dcPath']) {
            throw new Exception('Cannot find datacenter from URL');
        }
        if (!isset($query['dsName']) or !$query['dsName']) {
            throw new Exception('Cannot find datastore name from URL');
        }
        $obj = new self(urldecode($query['dsName']), urldecode($path), urldecode($query['dcPath']));
        $obj->host = $host;

        return $obj;
    }

    public static function fromStr(string $str): self
    {
        if (preg_match("/^https?:\/\/.*/", $str)) {
            return self::fromURL($str);
        }
        if (preg_match("/^\[(.*)\]\s+(.*)$/", $str)) {
            return self::fromDSPath($str);
        }

        throw new Exception('Unsupported format');
    }

    public string $datastore;
    public ?string $datacenter = null;
    public string $path;
    public ?string $host = null;

    public function __construct(string $datastore, string $path, ?string $datacenter = null)
    {
        $this->datastore = $datastore;
        $this->path = $path;
        $this->datacenter = $datacenter;
    }

    public function getDirname(): self
    {
        $parent = new self($this->datastore, dirname($this->path), $this->datacenter);
        $parent->host = $this->host;

        return $parent;
    }

    public function getBasename(): string
    {
        return basename($this->path);
    }

    public function toURL(?API $api = null): string
    {
        $host = $this->host;
        $datacenter = $this->datacenter;
        if (!$host) {
            if (!$api) {
                throw new Exception('host or api is required');
            }
            $sdkURL = $api->getOption('sdk');
            $sdkURL = parse_url($sdkURL);
            $host = "{$sdkURL['scheme']}://{$sdkURL['host']}";
        }
        if (!$datacenter) {
            if (!$api) {
                throw new Exception('datacenter or api is required');
            }
            if ('HostAgent' != $api->getApiType()) {
                throw new Exception('datacenter name is required');
            }
            $datacenter = 'ha-datacenter';
        }

        $path = ltrim($this->path, '/');

        return "{$host}/folder/{$path}?".http_build_query([
            'dcPath' => $datacenter,
            'dsName' => $this->datastore,
        ]);
    }

    public function toDSPath(): string
    {
        $path = ltrim($this->path, '/');
        if (empty($path)) {
            $path = '/';
        }

        return "[{$this->datastore}] {$path}";
    }

    public function equals(self $other): bool
    {
        return
            $this->datastore === $other->datastore and
            $this->datacenter === $other->datacenter and
            $this->path === $other->path and
            $this->host === $other->host
        ;
    }

    public function concat(string $path): self
    {
        $newPath = new self($this->datastore, $this->path.'/'.ltrim($path, '/'), $this->datacenter);
        $newPath->host = $this->host;

        return $newPath;
    }
}
