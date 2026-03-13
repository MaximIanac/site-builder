<?php

namespace Maximianac\SiteBuilder\Services\Managers\Clients\Page\Adapters;

use Illuminate\Support\Collection;
use Maximianac\SiteBuilder\Services\Content\Data\PageData;
use Maximianac\SiteBuilder\Services\Managers\Decorators\DataAdapter;
use Spatie\LaravelData\Data;

class PageDataAdapter extends DataAdapter
{
    public function transform(array $data): Collection|Data
    {
        $data['cblocks'] = collect($data['cblocks'] ?? [])
            ->map(fn ($cblock) => $this->mapCBlock($cblock))
            ->toArray();

        return PageData::from($data);
    }
    private function mapCBlock(array $cblock): array
    {
        $cblock['entries'] = collect($cblock['entries'] ?? [])
            ->values()
            ->map(fn ($entry, $index) => $this->mapEntry($entry, $index))
            ->toArray();

        return $cblock;
    }

    private function mapEntry(array $entry, int $order): array
    {
        $entry['order'] = $order;

        $entry['slides'] = collect($entry['slides'] ?? [])
            ->values()
            ->map(fn ($slide, $index) => $this->mapSlide($slide, $index))
            ->toArray();

        return $entry;
    }

    private function mapSlide(array $slide, int $order): array
    {
        $slide['order'] = $order;

        $slide['entries'] = collect($slide['entries'] ?? [])
            ->values()
            ->map(fn ($entry, $index) => $this->mapEntry($entry, $index))
            ->toArray();

        return $slide;
    }
}
