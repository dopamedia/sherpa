<?php
/**
 * User: Andreas Penz <office@dopa.media>
 * Date: 26.06.17
 */

namespace Sherpa\Framework;

use PHPUnit\Framework\TestCase;

class FlowBuilderTest extends TestCase
{
    public function testBuild()
    {
        $builder = new FlowBuilder();
        $this->assertInstanceOf(Flow::class, $builder->build());
    }
}
