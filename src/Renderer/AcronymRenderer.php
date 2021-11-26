<?php

namespace iggyvolz\Bachelors\Renderer;

class AcronymRenderer extends TagRenderer
{

    public function getTagName(): string
    {
        return "acronym";
    }

    public function render(RendererState $state): RendererState
    {
        // TODO use abbr here instead?
        return $state->withNewDestinationNode("acronym");
    }
}