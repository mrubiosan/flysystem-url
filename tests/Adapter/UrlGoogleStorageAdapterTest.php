<?php
namespace Mrubiosan\FlyUrlPlugin\Tests\Adapter;

use Google\Cloud\Storage\Bucket;
use Google\Cloud\Storage\StorageClient;
use Mrubiosan\FlyUrlPlugin\Adapter\UrlAdapterInterface;
use Mrubiosan\FlyUrlPlugin\Adapter\UrlGoogleStorageAdapter;
use PHPUnit\Framework\TestCase;

class UrlGoogleStorageAdapterTest extends TestCase
{
    public function testItIsInstantiable()
    {
        $storageClient = $this->prophesize(StorageClient::class);
        $bucket = $this->prophesize(Bucket::class);
        $instance = new UrlGoogleStorageAdapter($storageClient->reveal(), $bucket->reveal());
        $this->assertInstanceOf(UrlAdapterInterface::class, $instance);
    }
}
