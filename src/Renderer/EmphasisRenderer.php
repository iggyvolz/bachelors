<?php

namespace iggyvolz\Bachelors\Renderer;

class EmphasisRenderer extends TagRenderer
{

    public function getTagName(): string
    {
        return "emphasis";
    }

    public function render(RendererState $state): RendererState
    {

        /*
         * <em class="emphasis">
         */
        return $state->withNewDestinationNode("em", ["class" => "emphasis"]);
    }
}