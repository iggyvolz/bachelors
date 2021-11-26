<?php

namespace iggyvolz\Bachelors\Renderer;

class ProductNameRenderer extends TagRenderer
{

    public function getTagName(): string
    {
        return "productname";
    }

    public function render(RendererState $state): RendererState
    {

        /*
         * <span class="productname">
         */
        return $state->withNewDestinationNode("span", ["class" => "productname"]);
    }
}