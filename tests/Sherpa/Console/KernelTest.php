<?php
/**
 * User: Andreas Penz <office@dopa.media>
 * Date: 28.06.17
 */

namespace Sherpa\Console;

use PHPUnit\Framework\TestCase;

class KernelTest extends TestCase
{
    public function testBootInitializesContainer()
    {
        $kernelMock = $this->getKernelMock(['initContainer']);

        $kernelMock->expects($this->once())
            ->method('initContainer');

        $kernelMock->boot();
    }

    public function testBootSetsBootedFlagToTrue()
    {
        $kernelMock = $this->getKernelMock(['initContainer']);

        $kernelMock->boot();

        $this->assertTrue($kernelMock->isBooted());
    }

    public function testBootDoesNotBootTwice()
    {
        $kernelMock = $this->getKernelMock(['initContainer']);

        $kernelMock->expects($this->once())
            ->method('initContainer');

        $kernelMock->boot();
        $kernelMock->boot();
    }

    /**
     * @param array $methods
     * @return \PHPUnit_Framework_MockObject_MockObject|Kernel
    */
    protected function getKernelMock(array $methods)
    {
        return $this->getMockBuilder(Kernel::class)
            ->setMethods($methods)
            ->getMock();
    }
}
