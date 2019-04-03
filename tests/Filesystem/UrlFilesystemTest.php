<?php
namespace Mrubiosan\FlyUrlPlugin\Tests\Filesystem;

use Mrubiosan\FlyUrlPlugin\Adapter\UrlAdapterInterface;
use Mrubiosan\FlyUrlPlugin\Filesystem\UrlFilesystem;
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
