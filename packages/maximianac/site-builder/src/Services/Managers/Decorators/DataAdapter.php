<?php

namespace Maximianac\SiteBuilder\Services\Managers\Decorators;

use Illuminate\Support\Collection;
use Spatie\LaravelData\Data;

abstract class DataAdapter
{
    public function __construct() {}

    public static function make(): static
    {
        return new static();
    }

    abstract public function transform(array $data): Collection|Data;
}
