<?php
namespace Mrubiosan\FlyUrlPlugin\Tests;

use League\Flysystem\AdapterInterface;
use Mrubiosan\FlyUrlPlugin\AdapterHandlerInterface;
use Mrubiosan\FlyUrlPlugin\AdapterHandlerRepository;
use PHPUnit\Framework\TestCase;

class AdapterHandlerRepositoryTest extends TestCase
{
    public function testAdd()
    {
        $adapterHandlerMock = $this->prophesize(AdapterHandlerInterface::class);
        $testSubject = new AdapterHandlerRepository();
        $this->assertNull($testSubject->add($adapterHandlerMock->reveal()));
        return [$testSubject, $adapterHandlerMock];
    }

    /**
     * @depends testAdd
     */
    public function testFindFor($params)
    {
        list($testSubject, $adapterHandlerMock) = $params;
        $adapterMock = $this->prophesize(AdapterInterface::class);

        $adapterHandlerMock->supportsAdapter($adapterMock)
            ->shouldBeCalled()
            ->willReturn(true, false);

        $this->assertEquals($adapterHandlerMock->reveal(), $testSubject->findFor($adapterMock->reveal()));
        $this->assertNull($testSubject->findFor($adapterMock->reveal()));
    }
}
