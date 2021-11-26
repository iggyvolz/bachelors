<?php
namespace iggyvolz\Bachelors\Renderer;

use DOMDocument;
use DOMNode;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;

class Renderer
{
    public function __construct(
        private DOMDocument $sourceDocument,
        private LoggerInterface $logger = new NullLogger(),
        private ?array $filter = null,
    )
    {
        $this->genericRenderer = new GenericRenderer($this->logger);
        foreach (self::RENDERER_CLASSES as $rendererClass) {
            /**
             * @var TagRenderer $renderer
             */
            $renderer = new $rendererClass($this->logger);
            $this->renderers[$renderer->getTagName()] = $renderer;
        }
    }

    /**
     * @var class-string<TagRenderer>
     */
    const RENDERER_CLASSES = [
        TextRenderer::class,
        Sect1Renderer::class,
        Sect2Renderer::class,
        Sect3Renderer::class,
        TitleRenderer::class,
        ParaRenderer::class,
        NoteRenderer::class,
        LinkRenderer::class,
        AcronymRenderer::class,
        CommentRenderer::class,
        ProductNameRenderer::class,
        FunctionRenderer::class,
        CdataRenderer::class,
        ScreenRenderer::class,
        TableRenderer::class,
        TgroupRenderer::class,
        TheadRenderer::class,
        RowRenderer::class,
        EntryRenderer::class,
        TbodyRenderer::class,
        ParameterRenderer::class,
        TypeRenderer::class,
        ConstantRenderer::class,
        EmphasisRenderer::class,
        LiteralRenderer::class,
        FilenameRenderer::class,
        WarningRenderer::class,
    ];

    /**
     * @var TagRenderer[]
     */
    private array $renderers = [];
    private TagRenderer $genericRenderer;

    private function matches(string $id): bool
    {
        if(is_null($this->filter)) return true;
        foreach($this->filter as $filter) {
            if(str_starts_with($id, $filter)) return true;
        }
        return false;
    }

    public function process(string $outputDir): void
    {
        $destinationDocument = new DOMDocument();
        $rendererState = new RendererState(
            $this->sourceDocument,
            $destinationDocument
        );
        $outputState = $this->processNode($rendererState);
        // TODO: this should split out to multiple files - can't figure out where they should split for the life of me
        $outputState->destinationDocument->saveHTMLFile("$outputDir/index.html");
    }

    private function processNode(
        RendererState $rendererState,
    ): RendererState
    {
        // Some HTML beautification to save my sanity
        if($rendererState->tagLevel > 0) {
            $rendererState->destinationNode->appendChild($rendererState->destinationDocument->createTextNode("\n" . str_repeat("\t", $rendererState->tagLevel)));
        }
        $renderer = $this->renderers[$rendererState->sourceNode->nodeName] ?? $this->genericRenderer;
        $outputState = $renderer->render($rendererState);
        /**
         * @var DOMNode $childNode
         */
        foreach($outputState->sourceNode->childNodes as $childNode) {
            $this->processNode($outputState->withNewChild($childNode));
        }
        if($rendererState->tagLevel > 0) {
            $rendererState->destinationNode->appendChild($rendererState->destinationDocument->createTextNode("\n" . str_repeat("\t", $rendererState->tagLevel - 1)));
        }
        return $outputState;
    }

    public static function getDocument(DOMNode $node): DOMDocument
    {
        if($node instanceof DOMDocument) {
            return $node;
        }
        if($node->ownerDocument) {
            return $node->ownerDocument;
        }
        throw new \LogicException("Could not find document");
    }
}