<?php
namespace Mrubiosan\FlyUrl\Tests\Adapter;

use MicrosoftAzure\Storage\Blob\BlobRestProxy;
use Mrubiosan\FlyUrl\Adapter\UrlAzureBlobStorageAdapter;
use PHPUnit\Framework\TestCase;

class UrlAzureBlobStorageAdapterTest extends TestCase
{
    private $clientMock;

    private $testSubject;

    protected function setUp()
    {
        $this->clientMock = $this->prophesize(BlobRestProxy::class);
        $this->testSubject = new UrlAzureBlobStorageAdapter(
            $this->clientMock->reveal(),
            'mycontainer'
        );
    }

    public function testGetUrl()
    {
        $this->clientMock->getBlobUrl('mycontainer', 'foo/bar')
            ->shouldBeCalled()
            ->willReturn('http://example.com/foo/bar');

        $this->assertEquals('http://example.com/foo/bar', $this->testSubject->getUrl('foo/bar'));
    }

    public function testGetUrlWithPrefix()
    {
        $this->clientMock->getBlobUrl('mycontainer', 'a-prefix/foo/bar')
            ->shouldBeCalled()
            ->willReturn('http://example.com/a-prefix/foo/bar');

        $this->testSubject->setPathPrefix('a-prefix');
        $this->assertEquals('http://example.com/a-prefix/foo/bar', $this->testSubject->getUrl('foo/bar'));
    }
}
