<?php

namespace Maximianac\SiteBuilder\Services\Utils;

use Illuminate\Support\ServiceProvider;
use InvalidArgumentException;

class UtilsServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        foreach (config('site-builder.utils', []) as $key => $class) {
            if (!class_exists($class)) {
                throw new InvalidArgumentException("Class {$class} for util key '{$key}' does not exist.");
            }

            $this->app->singleton($key, fn () => $class::make());
        }
    }
}
