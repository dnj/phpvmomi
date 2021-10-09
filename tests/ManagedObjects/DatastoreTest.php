<?php

namespace dnj\phpvmomi\Tests\ManagedObjects;

use dnj\phpvmomi\ManagedObjects\Datastore;
use dnj\phpvmomi\Tests\TestCase;

class DatastoreList extends TestCase
{
    public function testList()
    {
        $api = $this->getAPI();
        $datastore = new Datastore($api);

        $allDatastores = $datastore->list();
        $allDatastoresId = array_column($allDatastores, 'id');
        $this->assertContains($this->getDatastoreID(), $allDatastoresId);
    }
}
