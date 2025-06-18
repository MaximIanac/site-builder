<?php

namespace Maximianac\SiteBuilder\Services\Content\Processors;

use InvalidArgumentException;
use Maximianac\SiteBuilder\Utility\Enums\ContentType;

class ProcessorFactory
{
    public static function getProcessor(ContentType $type): BaseProcessor
    {
        return match ($type) {
            ContentType::Default => new DefaultProcessor(),
            ContentType::Panel => new PanelProcessor(),

            default => throw new InvalidArgumentException("Unsupported content type"),
        };
    }
}
