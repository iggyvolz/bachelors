<?php

namespace iggyvolz\Bachelors\Renderer;

class EntryRenderer extends TagRenderer
{

    public function getTagName(): string
    {
        return "entry";
    }

    public function render(RendererState $state): RendererState
    {

        /*
         * <row>
         */
        return $state->withNewDestinationNode("td");
    }
}