<?php
/**
 * User: Andreas Penz <office@dopa.media>
 * Date: 26.06.17
 */

namespace Sherpa\Framework;

use PHPUnit\Framework\TestCase;

class FlowTest extends TestCase
{
    public function testProcess()
    {
        /** @var \PHPUnit_Framework_MockObject_MockObject|ProcessorInterface $processorMock */
        $processorMock = $this->getMockBuilder(ProcessorInterface::class)->getMock();

        /** @var \PHPUnit_Framework_MockObject_MockObject|ExchangeInterface $exchangeMock */
        $exchangeMock = $this->getMockBuilder(ExchangeInterface::class)->getMock();

        $flow = new Flow([], $processorMock);

        $processorMock->expects($this->once())
            ->method('process')
            ->with([], $exchangeMock);

        $flow->process($exchangeMock);

    }
}
