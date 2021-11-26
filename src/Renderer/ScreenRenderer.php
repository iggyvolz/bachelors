<?php

namespace iggyvolz\Bachelors\Renderer;

class ScreenRenderer extends TagRenderer
{

    public function getTagName(): string
    {
        return "screen";
    }

    public function render(RendererState $state): RendererState
    {

        /*
         * <div class="example-contents screen">
         */
        return $state->withNewDestinationNode("div", ["class" => "example-contents screen"]);
    }
}