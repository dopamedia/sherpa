<?php
/**
 * User: Andreas Penz <office@dopa.media>
 * Date: 26.06.17
 */

namespace Sherpa\Framework;

use PHPUnit\Framework\TestCase;

class ExchangeTest extends TestCase
{
    public function testFlip()
    {
        $exchange = new Exchange();
        $exchange->flip();

        $this->assertNull($exchange->getIn()->getBody());

        $message = new Message();
        $message->setBody('dummy');
        $exchange->setOut($message);
        $exchange->flip();

        $this->assertEquals($message, $exchange->getIn());
    }
}
