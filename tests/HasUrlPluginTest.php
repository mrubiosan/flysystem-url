<?php
namespace Mrubiosan\FlyUrlPlugin\Tests;

use League\Flysystem\AdapterInterface;
use League\Flysystem\Filesystem;
use League\Flysystem\FilesystemInterface;
use Mrubiosan\FlyUrlPlugin\AdapterHandler\AdapterHandlerInterface;
use Mrubiosan\FlyUrlPlugin\AdapterHandler\AdapterHandlerRepository;
use Mrubiosan\FlyUrlPlugin\Exception\NoAdapterException;
use Mrubiosan\FlyUrlPlugin\HasUrlPlugin;
use PHPUnit\Framework\TestCase;

class HasUrlPluginTest extends TestCase
{
    private $testSubject;

    private $adapterHandlerRepoMock;

    private $filesystemMock;

    protected function setUp()
    {
        $this->adapterHandlerRepoMock = $this->prophesize(AdapterHandlerRepository::class);
        $this->filesystemMock = $this->prophesize(Filesystem::class);
        $this->testSubject = new HasUrlPlugin($this->adapterHandlerRepoMock->reveal());
        $this->testSubject->setFilesystem($this->filesystemMock->reveal());
    }

    public function testGetMethod()
    {
        $this->assertSame('hasUrl', $this->testSubject->getMethod());
    }

    public function testHandle()
    {
        $adapterMock = $this->prophesize(AdapterInterface::class);
        $this->filesystemMock->getAdapter()
            ->willReturn($adapterMock);

        $adapterHandlerMock = $this->prophesize(AdapterHandlerInterface::class);
        $this->adapterHandlerRepoMock->findFor($adapterMock)
            ->willReturn($adapterHandlerMock, null);

        $this->assertTrue($this->testSubject->handle('foo/bar'));
        $this->assertFalse($this->testSubject->handle('foo/bar'));
    }

    public function testHandleMissingAdapter()
    {
        $this->filesystemMock->getAdapter()
            ->willThrow(NoAdapterException::class);

        $this->assertFalse($this->testSubject->handle('foo/bar'));
    }

    public function testFilesystemWithoutGetAdapter()
    {
        $fsMock = $this->createMock(FilesystemInterface::class);
        $testSubject = new HasUrlPlugin($this->adapterHandlerRepoMock->reveal());
        $testSubject->setFilesystem($fsMock);
        $this->assertFalse($testSubject->handle('foo/bar'));
    }
}
