<?php

namespace iggyvolz\Bachelors\Renderer;

class RowRenderer extends TagRenderer
{

    public function getTagName(): string
    {
        return "row";
    }

    public function render(RendererState $state): RendererState
    {

        /*
         * <row>
         */
        return $state->withNewDestinationNode("tr");
    }
}