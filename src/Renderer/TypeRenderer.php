<?php

namespace iggyvolz\Bachelors\Renderer;

class TypeRenderer extends TagRenderer
{

    public function getTagName(): string
    {
        return "type";
    }

    public function render(RendererState $state): RendererState
    {

        /*
         * <span class="type">
         */
        return $state->withNewDestinationNode("span", ["class" => "type"]);
    }
}