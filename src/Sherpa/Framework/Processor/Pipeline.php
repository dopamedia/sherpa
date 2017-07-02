<?php
/**
 * User: Andreas Penz <office@dopa.media>
 * Date: 02.07.17
 */

namespace Sherpa\Framework\Processor;

use Sherpa\Framework\ProcessorInterface;
use Sherpa\Framework\ServiceInterface;
use Sherpa\Framework\Util\ServiceHelper;
use Sherpa\Framework\ExchangeInterface;

/**
 * Class Pipeline
 * @package Sherpa\Framework\Processor
 */
class Pipeline implements ProcessorInterface, ServiceInterface
{
    /**
     * @var ProcessorInterface[]
     */
    private $processors;

    /**
     * Pipeline constructor.
     * @param ProcessorInterface[] $processors
     */
    public function __construct(array $processors)
    {
        $this->processors = $processors;
    }

    /**
     * @param array $processors
     * @return null|ProcessorInterface
     */
    public static function newInstance(array $processors): ?ProcessorInterface
    {
        if (empty($processors)) {
            return null;
        } elseif (count($processors) == 1) {
            return $processors[0];
        }
        return new Pipeline($processors);
    }

    /**
     * @inheritDoc
     */
    public function start(): void
    {
        ServiceHelper::startServices($this->processors);
    }

    /**
     * @param ExchangeInterface $exchange
     */
    public function process(ExchangeInterface $exchange): void
    {
        $nextExchange = $exchange;

        for ($i = 0; $i < count($this->processors); $i++) {

            /** @var ProcessorInterface $currentProcessor */
            $currentProcessor = $this->processors[$i];

            if ($i > 0) {
                $nextExchange = $this->createNextExchange($nextExchange);
            }

            $currentProcessor->process($nextExchange);
        }

    }

    /**
     * @param ExchangeInterface $previousExchange
     * @return ExchangeInterface
     */
    protected function createNextExchange(
        ExchangeInterface $previousExchange
    ): ExchangeInterface
    {
        $nextExchange = $previousExchange->copy();
        $nextExchange->getIn()->setBody($previousExchange->getOut()->getBody());
        return $nextExchange;
    }

}