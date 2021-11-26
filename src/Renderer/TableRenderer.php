<?php

namespace iggyvolz\Bachelors\Renderer;

class TableRenderer extends TagRenderer
{

    public function getTagName(): string
    {
        return "table";
    }

    public function render(RendererState $state): RendererState
    {

        /*
         * <table>
         */
        return $state->withNewDestinationNode("table");
    }
}