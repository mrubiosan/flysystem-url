<?php
namespace Mrubiosan\FlyUrl\Tests\Filesystem;

use Mrubiosan\FlyUrl\Adapter\UrlAdapterInterface;
use Mrubiosan\FlyUrl\Filesystem\UrlFilesystem;
use PHPUnit\Framework\TestCase;

class UrlFilesystemTest extends TestCase
{
    public function testGetUrl()
    {
        $urlAdapterMock = $this->prophesize(UrlAdapterInterface::class);

        $urlAdapterMock->getUrl('moo')
            ->shouldBeCalled()
            ->willReturn('http://example.com');

        $testSubject = new UrlFilesystem($urlAdapterMock->reveal());
        $this->assertEquals('http://example.com', $testSubject->getUrl('moo'));
    }
}
