<?php

namespace iggyvolz\Bachelors\Renderer;

class WarningRenderer extends TagRenderer
{

    public function getTagName(): string
    {
        return "warning";
    }

    public function render(RendererState $state): RendererState
    {

        /*
         * <div class="warning"><strong class="warning">Warning</strong>
         */
        $outputState = $state->withNewDestinationNode("div", ["class" => "warning"]);
        $outputState->createNodeInChild("strong", ["class" => "warning"])->appendChild($outputState->createTextNode("Warning"));
        return $outputState;
    }
}