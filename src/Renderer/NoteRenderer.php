<?php

namespace iggyvolz\Bachelors\Renderer;

class NoteRenderer extends TagRenderer
{

    public function getTagName(): string
    {
        return "note";
    }

    public function render(RendererState $state): RendererState
    {

        /*
         * <blockquote class="note"><p><strong class="note">Note</strong>
         */
        $outputState = $state->withNewDestinationNode("blockquote", ["class" => "note"])->withNewDestinationNode("p");
        $outputState->createNodeInChild("strong", ["class" => "note"])->appendChild($outputState->createTextNode("Note"));
        return $outputState;
    }
}