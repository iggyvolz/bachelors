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
        foreach($this->sourceDocument->getElementsByTagName("sect1") as $article) {
            $id = $article->attributes["xml.id"]?->value;
            if(!$id || $id === "false") continue;
            if(!$this->matches($id)) continue;
            $this->logger->info("Processing $id");
            $destinationDocument = new DOMDocument();
            $destinationDocument->preserveWhiteSpace = true;
            $rendererState = new RendererState(
                $article,
                $destinationDocument
            );
            $outputState = $this->processNode($rendererState);
            $outputState->destinationDocument->saveHTMLFile("$outputDir/$id.php");
        }
    }

    private function processNode(
        RendererState $rendererState
    ): RendererState
    {
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