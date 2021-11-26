<?php

namespace iggyvolz\Bachelors\Renderer;

class CommentRenderer extends TagRenderer
{

    public function getTagName(): string
    {
        return "#comment";
    }

    public function render(RendererState $state): RendererState
    {
        // Intentionally left empty
        return $state;
    }
}