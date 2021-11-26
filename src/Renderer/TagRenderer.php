<?php

namespace iggyvolz\Bachelors\Renderer;

use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;

abstract class TagRenderer
{
    public final function __construct(
        protected readonly LoggerInterface $logger = new NullLogger(),
    )
    {
    }

    /**
     * @return string Tag name that this renderer can process
     */
    public abstract function getTagName(): string;

    /**
     * @param RendererState $state Input state
     * @return RendererState Input state for inner elements
     */
    public abstract function render(RendererState $state) : RendererState;
}