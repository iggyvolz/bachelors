<?php

namespace iggyvolz\Bachelors\Renderer;

use DOMNode;

class RendererState
{
    public readonly \DOMDocument $sourceDocument;
    public readonly \DOMDocument $destinationDocument;
    public function __construct(
        public readonly DOMNode $sourceNode,
        public readonly DOMNode $destinationNode,
        public readonly int $tagLevel = 0,
    )
    {
        $this->sourceDocument = Renderer::getDocument($this->sourceNode);
        $this->destinationDocument = Renderer::getDocument($this->destinationNode);
    }

    public function createNode(string $name, array $attributes = []): DOMNode
    {
        $node = $this->destinationDocument->createElement($name);
        foreach($attributes as $key => $value) {
            if(!is_string($value)) continue;
            $node->setAttribute($key, $value);
        }
        return $node;
    }

    public function createAndAppendNode(string $name, array $attributes = []): DOMNode
    {
        return $this->destinationNode->appendChild($this->createNode($name, $attributes));
    }

    public function createNodeInChild(string $name, array $attributes = []): DOMNode
    {
        return $this->destinationNode->appendChild($this->createNode($name, $attributes));
    }

    public function createTextNode(string $string): DOMNode
    {
        return $this->destinationDocument->createTextNode($string);
    }

    public function withNewDestinationNode(string $name, array $attributes = []): self
    {
        return new self(
            sourceNode: $this->sourceNode,
            destinationNode: $this->createAndAppendNode($name, $attributes),
            tagLevel: $this->tagLevel,
        );
    }

    public function withNewChild(DOMNode $sourceNode): self
    {
        return new self(
            sourceNode: $sourceNode,
            destinationNode: $this->destinationNode,
            tagLevel: $this->tagLevel + 1
        );
    }
}