<?php

namespace iggyvolz\Bachelors\Renderer;

class FilenameRenderer extends TagRenderer
{

    public function getTagName(): string
    {
        return "filename";
    }

    public function render(RendererState $state): RendererState
    {

        /*
         * <var class="filename">
         */
        return $state->withNewDestinationNode("var", ["class" => "filename"]);
    }
}