<?php
/**
 * User: Andreas Penz <office@dopa.media>
 * Date: 28.06.17
 */

namespace Sherpa\Console;

use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class ApplicationTest extends TestCase
{
    public function testFind()
    {
        /** @var \PHPUnit_Framework_MockObject_MockObject|Kernel $kernelMock */
        $kernelMock = $this->getMockBuilder(Kernel::class)->getMock();

        $command = new Command('example');

        /** @var \PHPUnit_Framework_MockObject_MockObject|ContainerBuilder $containerBuilderMock */
        $containerBuilderMock = $this->getMockBuilder(ContainerBuilder::class)->getMock();

        $containerBuilderMock->expects($this->once())
            ->method('hasParameter')
            ->with('console.command.ids')
            ->willReturn(true);

        $containerBuilderMock->expects($this->once())
            ->method('getParameter')
            ->with('console.command.ids')
            ->willReturn(['example_command_id']);

        $containerBuilderMock->expects($this->once())
            ->method('get')
            ->with('example_command_id')
            ->willReturn($command);

        $kernelMock->expects($this->once())
            ->method('getContainer')
            ->willReturn($containerBuilderMock);

        $application = new Application($kernelMock);

        $this->assertSame($command, $application->find('example'));
    }

    /**
     * @group current
     */
    public function testAll()
    {
        /** @var \PHPUnit_Framework_MockObject_MockObject|Kernel $kernelMock */
        $kernelMock = $this->getMockBuilder(Kernel::class)->getMock();

        $firstCommand = new Command('first');
        $secondCommand = new Command('second');

        /** @var \PHPUnit_Framework_MockObject_MockObject|ContainerBuilder $containerBuilderMock */
        $containerBuilderMock = $this->getMockBuilder(ContainerBuilder::class)->getMock();

        $containerBuilderMock->expects($this->once())
            ->method('hasParameter')
            ->with('console.command.ids')
            ->willReturn(true);

        $containerBuilderMock->expects($this->exactly(1))
            ->method('getParameter')
            ->with('console.command.ids')
            ->willReturn(['first_command_id', 'second_command_id']);

        $map = [
            ['first_command_id', 1, $firstCommand],
            ['second_command_id', 1, $secondCommand]
        ];

        $containerBuilderMock->expects($this->exactly(2))
            ->method('get')
            ->will($this->returnValueMap($map));

        $kernelMock->expects($this->once())
            ->method('getContainer')
            ->willReturn($containerBuilderMock);

        $application = new Application($kernelMock);

        $commands = $application->all();

        $this->assertContains($firstCommand, $commands);
        $this->assertContains($secondCommand, $commands);
    }
}
