<?php

namespace iggyvolz\Bachelors\Renderer;

class TgroupRenderer extends TagRenderer
{

    public function getTagName(): string
    {
        return "tgroup";
    }

    public function render(RendererState $state): RendererState
    {

        /*
         * <tgroup cols="cols">
         */
        return $state->withNewDestinationNode("tgroup", ["cols" => $state->sourceNode->attributes["cols"]->textContent]);
    }
}