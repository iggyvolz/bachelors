<?php

namespace iggyvolz\Bachelors\Renderer;

class TitleRenderer extends TagRenderer
{

    public function getTagName(): string
    {
        return "title";
    }

    public function render(RendererState $state): RendererState
    {
        return match($state->sourceNode->parentNode->nodeName) {
            "sect1" => $state->withNewDestinationNode("h2", ["class" => "title"]),
            "sect2" => $state->withNewDestinationNode("h3", ["class" => "title"]),
            "sect3" => $state->withNewDestinationNode("h4", ["class" => "title"]),
            "sect4" => $state->withNewDestinationNode("h5", ["class" => "title"]),
            "table" => $state->withNewDestinationNode("caption")->withNewDestinationNode("strong"),
            "note" => $state->withNewDestinationNode("strong"),
            default => $state->withNewDestinationNode("span"),
        };
    }
}