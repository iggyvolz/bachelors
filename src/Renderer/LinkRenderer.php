<?php

namespace iggyvolz\Bachelors\Renderer;

class LinkRenderer extends TagRenderer
{

    public function getTagName(): string
    {
        return "link";
    }

    public function render(RendererState $state): RendererState
    {

        /*
         * <link linkend="about.notes">  or <link xlink:href="&url.php.urlhowto;"> => <a href="...">
         */
        $href = "#";
        if($state->sourceNode->attributes["linkend"]) {
            $href = $state->sourceNode->attributes["linkend"]->value;
        }
        if($state->sourceNode->attributes["xlink:href"]) {
            $href = $state->sourceNode->attributes["xlink:href"]->value;
        }
        return $state->withNewDestinationNode("a", ["href" => $href]);
    }
}