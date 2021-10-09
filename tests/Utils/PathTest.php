<?php

namespace dnj\phpvmomi\Tests\Utils;

use dnj\phpvmomi\API;
use dnj\phpvmomi\Tests\TestCase;
use dnj\phpvmomi\Utils\Path;

class PathTest extends TestCase
{
    public function testURL()
    {
        $host = 'https://ip-94-130-114-117.jeyserver.net';
        $url = "{$host}/folder/iso/6d73584825007a9641d11122c15dff02%2eiso?dcPath=OVH&dsName=datastore3";
        $path = Path::fromURL($url);
        $this->assertInstanceOf(Path::class, $path);
        $this->assertEquals($host, $path->host);
        $this->assertEquals('iso/6d73584825007a9641d11122c15dff02.iso', $path->path);
        $this->assertEquals('6d73584825007a9641d11122c15dff02.iso', $path->getBasename());
        $this->assertEquals('OVH', $path->datacenter);
        $this->assertEquals('datastore3', $path->datastore);

        $path2 = Path::fromStr($url);
        $this->assertTrue($path->equals($path2));

        $newURL = $path->toURL();
        $this->assertStringStartsWith("{$host}/folder/", $newURL);
        $this->assertStringContainsString('dcPath=OVH', $newURL);
        $this->assertStringContainsString('dsName=datastore3', $newURL);

        $api = $this->createStub(API::class);
        $api->method('getApiType')->willReturn('HostAgent');
        $api->method('getOption')->willReturn("{$host}/sdk/");
        $path2->host = null;

        $this->assertEquals($path->toURL(), $path2->toURL($api));

        $path2->datacenter = null;
        $path2->toURL($api);
    }

    public function testDSPath()
    {
        $ds = 'datastore3';
        $file = 'iso/6d73584825007a9641d11122c15dff02.iso';
        $dsPath = "[{$ds}] {$file}";
        $path = Path::fromDSPath($dsPath);
        $this->assertInstanceOf(Path::class, $path);
        $this->assertNull($path->host);
        $this->assertEquals($file, $path->path);
        $this->assertEquals(basename($file), $path->getBasename());
        $this->assertNull($path->datacenter);
        $this->assertEquals($ds, $path->datastore);

        $path2 = Path::fromStr($dsPath);
        $this->assertTrue($path->equals($path2));
        $this->assertEquals($dsPath, $path->toDSPath());

        $this->assertEquals("[{$ds}] ".dirname($file), $path->getDirname()->toDSPath());
        $this->assertEquals("[{$ds}] /", (new Path($ds, '////'))->toDSPath());
    }
}
