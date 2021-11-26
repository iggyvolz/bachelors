<?php

namespace iggyvolz\Bachelors\Renderer;

class CdataRenderer extends TagRenderer
{

    public function getTagName(): string
    {
        return "#cdata-section";
    }

    public function render(RendererState $state): RendererState
    {

        /*
         * <div class="cdata"><pre>
         */
        return $state->withNewDestinationNode("div", ["class" => "cdata"])->withNewDestinationNode("pre");
    }
}