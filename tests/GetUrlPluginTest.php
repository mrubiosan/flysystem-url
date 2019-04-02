<?php
namespace Mrubiosan\FlyUrlPlugin\Tests;

use League\Flysystem\AdapterInterface;
use League\Flysystem\Filesystem;
use Mrubiosan\FlyUrlPlugin\AdapterHandler\AdapterHandlerInterface;
use Mrubiosan\FlyUrlPlugin\AdapterHandler\AdapterHandlerRepository;
use Mrubiosan\FlyUrlPlugin\Exception\UnsupportedAdapterException;
use Mrubiosan\FlyUrlPlugin\GetUrlPlugin;
use PHPUnit\Framework\TestCase;

class GetUrlPluginTest extends TestCase
{
    private $testSubject;

    private $adapterHandlerRepoMock;

    private $filesystemMock;

    protected function setUp()
    {
        $this->adapterHandlerRepoMock = $this->prophesize(AdapterHandlerRepository::class);
        $this->filesystemMock = $this->prophesize(Filesystem::class);
        $this->testSubject = new GetUrlPlugin($this->adapterHandlerRepoMock->reveal());
        $this->testSubject->setFilesystem($this->filesystemMock->reveal());
    }

    public function testGetMethod()
    {
        $this->assertSame('getUrl', $this->testSubject->getMethod());
    }

    public function testHandle()
    {
        $adapterMock = $this->prophesize(AdapterInterface::class);
        $this->filesystemMock->getAdapter()
            ->willReturn($adapterMock)
            ->shouldBeCalled();

        $adapterHandlerMock = $this->prophesize(AdapterHandlerInterface::class);
        $this->adapterHandlerRepoMock->findFor($adapterMock)
            ->shouldBeCalled()
            ->willReturn($adapterHandlerMock);

        $adapterHandlerMock->getUrl($adapterMock, '/foo/bar')
            ->willReturn('http://example.com');

        $this->assertEquals('http://example.com', $this->testSubject->handle('/foo/bar'));
    }

    public function testHandleMissingHandler()
    {
        $adapterMock = $this->prophesize(AdapterInterface::class);
        $this->filesystemMock->getAdapter()
            ->willReturn($adapterMock)
            ->shouldBeCalled();

        $this->adapterHandlerRepoMock->findFor($adapterMock)
            ->shouldBeCalled()
            ->willReturn();

        $this->expectException(UnsupportedAdapterException::class);
        $this->assertEquals('http://example.com', $this->testSubject->handle('/foo/bar'));
    }
}
