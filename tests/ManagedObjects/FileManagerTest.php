<?php

namespace dnj\phpvmomi\Tests\ManagedObjects;

use dnj\Filesystem\Local;
use dnj\Filesystem\Tmp;
use dnj\phpvmomi\Exception;
use dnj\phpvmomi\ManagedObjects\Datastore;
use dnj\phpvmomi\ManagedObjects\FileManager;
use dnj\phpvmomi\ManagedObjects\Task;
use dnj\phpvmomi\Tests\TestCase;

class FileManagerTest extends TestCase
{
    protected ?Local\File $fileToUpload = null;

    public function testUpload()
    {
        $api = $this->getAPI();
        $dsID = $this->getDatabaseID();

        $datastore = (new Datastore($api))->byID($dsID);
        $this->assertInstanceOf(Datastore::class, $datastore);

        $fileManager = $api->getFileManager();
        $this->assertInstanceOf(FileManager::class, $fileManager);

        $fileToUpload = $this->getFileToUpload();
        $url = $datastore->getFileURL('test-upload.txt');
        $fileManager->upload($url, $fileToUpload);

        $url = $datastore->getFileURL('test-upload.txt').'make-it-invalid';
        $this->expectException(Exception::class);
        $fileManager->upload($url, $fileToUpload);
    }

    /**
     * @depends testUpload
     */
    public function testDownload()
    {
        $api = $this->getAPI();
        $dsID = $this->getDatabaseID();

        $datastore = (new Datastore($api))->byID($dsID);
        $this->assertInstanceOf(Datastore::class, $datastore);

        $fileManager = $api->getFileManager();
        $this->assertInstanceOf(FileManager::class, $fileManager);

        $fileToUpload = $this->getFileToUpload();
        $url = $datastore->getFileURL('test-upload.txt');

        $fileToDownload = new Tmp\File();
        $fileManager->download($url, $fileToDownload);

        $this->assertEquals($fileToUpload->read(), $fileToDownload->read());

        $url = $datastore->getFileURL('non-exist-test-file.txt');
        $fileToDownload = new Tmp\File();

        $this->expectException(Exception::class);
        $fileManager->download($url, $fileToDownload);
    }

    /**
     * @depends testUpload
     */
    public function testCopy()
    {
        $api = $this->getAPI();
        $dsID = $this->getDatabaseID();

        $datastore = (new Datastore($api))->byID($dsID);
        $this->assertInstanceOf(Datastore::class, $datastore);

        $fileManager = $api->getFileManager();
        $this->assertInstanceOf(FileManager::class, $fileManager);

        $source = $datastore->getFileURL('test-upload.txt');
        $dest = $datastore->getFileURL('test-upload2.txt');

        $task = $fileManager->_CopyDatastoreFile_Task($source, $dest);
        $this->assertInstanceOf(Task::class, $task);

        $result = $task->waitFor(10);
        $this->assertTrue($result);
    }

    public function testMakeDirectory()
    {
        $api = $this->getAPI();
        $dsID = $this->getDatabaseID();

        $datastore = (new Datastore($api))->byID($dsID);
        $this->assertInstanceOf(Datastore::class, $datastore);

        $fileManager = $api->getFileManager();
        $this->assertInstanceOf(FileManager::class, $fileManager);

        $url = $datastore->getFileURL('test-new-directory');

        try {
            $fileManager->_MakeDirectory($url);
        } catch (\SoapFault $e) {
            if (false === strpos($e->getMessage(), 'already exists')) {
                throw $e;
            }
        }
    }

    /**
     * @depends testUpload
     * @depends testDownload
     * @depends testCopy
     * @depends testMakeDirectory
     */
    public function testDelete()
    {
        $api = $this->getAPI();
        $dsID = $this->getDatastoreID();

        $datastore = (new Datastore($api))->byID($dsID);
        $this->assertInstanceOf(Datastore::class, $datastore);

        $fileManager = $api->getFileManager();
        $this->assertInstanceOf(FileManager::class, $fileManager);

        foreach (['test-upload.txt', 'test-upload2.txt', 'test-new-directory'] as $file) {
            $url = $datastore->getFileURL($file);
            $task = $fileManager->_DeleteDatastoreFile_Task($url);
            $this->assertInstanceOf(Task::class, $task);

            $result = $task->waitFor(10);
            $this->assertTrue($result);
        }
    }

    protected function getFileToUpload(): Local\File
    {
        if (!$this->fileToUpload) {
            $this->fileToUpload = new Tmp\File();
            $this->fileToUpload->write(md5_file(__FILE__));
        }

        return $this->fileToUpload;
    }
}
