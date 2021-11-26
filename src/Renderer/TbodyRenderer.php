<?php

namespace iggyvolz\Bachelors\Renderer;

class TbodyRenderer extends TagRenderer
{

    public function getTagName(): string
    {
        return "tbody";
    }

    public function render(RendererState $state): RendererState
    {

        /*
         * <tbody>
         */
        return $state->withNewDestinationNode("tbody");
    }
}