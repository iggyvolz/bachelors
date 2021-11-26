<?php

namespace iggyvolz\Bachelors\Renderer;

class FunctionRenderer extends TagRenderer
{

    public function getTagName(): string
    {
        return "function";
    }

    public function render(RendererState $state): RendererState
    {

        /*
         * <span class="function"><a href="function.strlen.php" class="function">
         */
        return $state->withNewDestinationNode("span", ["class" => "function"])
            ->withNewDestinationNode("a", ["href" => "function." . $state->sourceNode->textContent . ".php", "class" => "function"]);
    }
}