<?php

namespace iggyvolz\Bachelors\Renderer;

class TheadRenderer extends TagRenderer
{

    public function getTagName(): string
    {
        return "thead";
    }

    public function render(RendererState $state): RendererState
    {

        /*
         * <thead>
         */
        return $state->withNewDestinationNode("thead");
    }
}