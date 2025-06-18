<?php

namespace Maximianac\SiteBuilder\Services\Content\Managers;

use InvalidArgumentException;
use Maximianac\SiteBuilder\Models\Content;
use Maximianac\SiteBuilder\Models\Page;
use Maximianac\SiteBuilder\Services\Content\Processors\BaseProcessor;
use Maximianac\SiteBuilder\Services\Content\Processors\ProcessorFactory;
use Maximianac\SiteBuilder\Utility\Enums\ContentType;
use Symfony\Component\HttpFoundation\FileBag;

class ContentManager
{
    protected Content $content;
    protected ?array $entityKeys;

    private BaseProcessor $processor;

    public function __construct(
        Page $page,
        string $key,
        string $type,
        ?array $entityKeys
    ) {
        $type = ContentType::tryFrom($type);

        $this->entityKeys = $entityKeys;
        $this->content = $this->init($page, $key, $type);
        $this->processor = (ProcessorFactory::getProcessor($type))
            ->setContent($this->content)
            ->self();
    }

    /**
     * Creates a new ContentManager instance statically.
     *
     * @param Page $page The page associated with the content
     * @param string $key Unique key for the content
     * @param string $type Type of content (e.g., Default or Panel)
     * @param array|null $entityKeys Optional entity keys for filtering
     * @return self
     */
    public static function from(
        Page $page,
        string $key,
        string $type,
        ?array $entityKeys = null
    ): self {
        return new self($page, $key, $type, $entityKeys);
    }

    /**
     * Returns the appropriate content manager based on content type.
     *
     * @return DefaultContentManager|PanelContentManager
     * @throws InvalidArgumentException If the content type is unsupported
     */
    public function block(): DefaultContentManager|PanelContentManager
    {
        return match($this->content->type) {
            ContentType::Panel => new PanelContentManager($this->content, $this->entityKeys),
            ContentType::Default => new DefaultContentManager($this->content, $this->entityKeys),

            default => throw new InvalidArgumentException("Unsupported content type: {$this->content->type}")
        };
    }

    public function processor(?FileBag $files = null): BaseProcessor
    {
        return $this->processor->setFiles($files)->self();
    }

    private function init(Page $page, string $key, ContentType $type): Content
    {
        return $page->contents()->updateOrCreate(
            ['key' => $key],
            ['type' => $type]
        );
    }
}
