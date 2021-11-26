<?php

namespace iggyvolz\Bachelors\Renderer;

final class TextRenderer extends TagRenderer
{

    /**
     * @inheritDoc
     */
    public function getTagName(): string
    {
        return "#text";
    }

    /**
     * @inheritDoc
     */
    public function render(RendererState $state): RendererState
    {
        return new RendererState(
            sourceNode: $state->sourceNode,
            destinationNode: $state->destinationNode->appendChild($state->createTextNode($state->sourceNode->textContent)),
            tagLevel: $state->tagLevel,
        );
    }
}