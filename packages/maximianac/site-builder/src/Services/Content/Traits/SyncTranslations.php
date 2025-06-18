<?php

namespace Maximianac\SiteBuilder\Services\Content\Traits;

use Illuminate\Support\Facades\DB;

trait SyncTranslations
{
    public function syncTranslations(array $translations, string $relation = 'translations'): void
    {
        $processed = [];

        DB::transaction(function() use ($translations, $relation, &$processed) {
            foreach ($translations as $item) {
                $lang = $item['lang'];
                $processed[] = $lang;

                if (empty($item['value'])) {
                    $this->{$relation}()->where('lang', $lang)->delete();
                    continue;
                }

                $this->{$relation}()->updateOrCreate(
                    ['lang' => $lang],
                    [
                        'value' => $item['value'],
                        'meta' => $item['meta'] ?? null
                    ]
                );
            }
        });

        $this->{$relation}()
            ->whereNotIn('lang', $processed)
            ->delete();
    }
}
