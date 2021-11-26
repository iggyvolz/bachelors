<?php

namespace iggyvolz\Bachelors\Renderer;

class ParameterRenderer extends TagRenderer
{

    public function getTagName(): string
    {
        return "parameter";
    }

    public function render(RendererState $state): RendererState
    {

        /*
         * <code class="parameter">
         */
        return $state->withNewDestinationNode("code", ["class" => "parameter"]);
    }
}