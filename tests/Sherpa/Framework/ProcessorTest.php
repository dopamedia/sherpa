<?php
/**
 * User: Andreas Penz <office@dopa.media>
 * Date: 26.06.17
 */

namespace Sherpa\Framework;

use PHPUnit\Framework\TestCase;

class ProcessorTest extends TestCase
{
    public function testProcess()
    {
        /** @var \PHPUnit_Framework_MockObject_MockObject|ExchangeInterface $exchangeMock */
        $exchangeMock = $this->getMockBuilder(ExchangeInterface::class)->getMock();

        /** @var \PHPUnit_Framework_MockObject_MockObject|StageInterface $stageMock */
        $stageMock = $this->getMockBuilder(StageInterface::class)->getMock();

        $processor = new Processor();

        $stageMock->expects($this->once())
            ->method('process')
            ->with($exchangeMock);

        $exchangeMock->expects($this->once())
            ->method('flip');

        $processor->process([$stageMock], $exchangeMock);
    }
}
