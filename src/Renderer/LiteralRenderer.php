<?php

namespace iggyvolz\Bachelors\Renderer;

class LiteralRenderer extends TagRenderer
{

    public function getTagName(): string
    {
        return "literal";
    }

    public function render(RendererState $state): RendererState
    {

        /*
         * <code class="literal">
         */
        return $state->withNewDestinationNode("code", ["class" => "literal"]);
    }
}