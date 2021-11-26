<?php

namespace iggyvolz\Bachelors\Renderer;

use Psr\Log\NullLogger;

class GenericRenderer extends TagRenderer
{
    private array $warnedTags = [];
    public function getTagName(): string
    {
        return "";
    }

    public function render(RendererState $state): RendererState
    {
        if(!in_array($state->sourceNode->nodeName, $this->warnedTags)) {
            $this->warnedTags[]=$state->sourceNode->nodeName;
            $this->logger->warning("Unknown tag #".count($this->warnedTags).":  " . $state->sourceNode->nodeName);
        }
        return $state->withNewDestinationNode("span", ["xml-tag" => $state->sourceNode->nodeName]);
    }
}