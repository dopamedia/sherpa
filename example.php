<?php
/**
 * User: Andreas Penz <office@dopa.media>
 * Date: 13.06.17
 */

use Sherpa\Framework\ExchangeInterface;
use Sherpa\Framework\StageInterface;

require 'vendor/autoload.php';

class FirstStage implements StageInterface
{
    public function process(ExchangeInterface $exchange): ExchangeInterface
    {
        $message = $exchange->getOut();
        $message->setBody('first stage');
        $exchange->setOut($message);

        return $exchange;
    }
}

class SecondStage implements StageInterface
{
    public function process(ExchangeInterface $exchange): ExchangeInterface
    {
        $out = $exchange->getOut();
        $out->setBody($exchange->getIn()->getBody() . ' - second stage');
        return $exchange;
    }
}

$flowBuilder = (new \Sherpa\Framework\FlowBuilder())
    ->add(new FirstStage)
    ->add(new SecondStage);

$flow = $flowBuilder->build();

$exchange = new \Sherpa\Framework\Exchange();

var_dump($flow->process($exchange));
