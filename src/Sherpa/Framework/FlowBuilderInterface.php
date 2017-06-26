<?php
/**
 * User: Andreas Penz <office@dopa.media>
 * Date: 26.06.17
 */

namespace Sherpa\Framework;

/**
 * Interface FlowBuilderInterface
 * @package Sherpa\Framework
 */
interface FlowBuilderInterface
{
    /**
     * @param StageInterface $stage
     * @return FlowBuilderInterface
     */
    public function add(StageInterface $stage): FlowBuilderInterface;

    /**
     * @return StageInterface
     */
    public function build(): StageInterface;

}