<?php

namespace iggyvolz\Bachelors\Renderer;

class ConstantRenderer extends TagRenderer
{

    public function getTagName(): string
    {
        return "constant";
    }

    public function render(RendererState $state): RendererState
    {

        /*
         * <strong><code>
         */
        return $state->withNewDestinationNode("strong")->withNewDestinationNode("code");
    }
}