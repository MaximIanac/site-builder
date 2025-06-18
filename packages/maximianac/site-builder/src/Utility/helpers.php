<?php

use Maximianac\SiteBuilder\Models\MessageTranslation;

if (!function_exists('translate')) {
    function translate(string $group, string $key, ?string $default = null): string
    {
        return MessageTranslation::where('group', $group)
            ->where('key', $key)
            ->where('lang', app()->getLocale())
            ->value('text') ?? $default ?? $key;
    }
}
