<?php

namespace iggyvolz\Bachelors\Renderer;

abstract class SectRenderer extends TagRenderer
{
    public abstract function getLevel(): int;
    /**
     * @inheritDoc
     */
    public function getTagName(): string
    {
        return "sect" . $this->getLevel();
    }

    /**
     * @inheritDoc
     */
    public function render(RendererState $state): RendererState
    {
        // <div id="(node id)" class="sect(1,2,3)">
        $level = $this->getLevel();
        $attributes = ["class" => "sect$level"];
        $id = $state->sourceNode->attributes["id"]?->value;
        if(!is_null($id)) {
            $attributes["id"] = $id;
        }
        return $state->withNewDestinationNode("div", $attributes);
    }
}