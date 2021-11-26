<?php

namespace iggyvolz\Bachelors\Renderer;

class ParaRenderer extends TagRenderer
{

    public function getTagName(): string
    {
        return "para";
    }

    public function render(RendererState $state): RendererState
    {
        // <p class="para">
        return $state->withNewDestinationNode("p", ["class" => "para"]);
    }
}