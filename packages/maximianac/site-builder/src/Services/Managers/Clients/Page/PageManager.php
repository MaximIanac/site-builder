<?php

namespace Maximianac\SiteBuilder\Services\Managers\Clients\Page;

use DB;
use Exception;
use Maximianac\SiteBuilder\Models\Page;
use Maximianac\SiteBuilder\Services\Managers\Clients\ModelManager;
use Maximianac\SiteBuilder\Services\Managers\Traits\HasRelations;
use Throwable;

class PageManager extends ModelManager
{
    use HasRelations;

    protected function straightRelations(): array
    {
        return ['cblocks'];
    }

    protected function nestedRelations(): array
    {
        return [
            "cblocks" => [
                'entries',
                'entries.slides',
                'entries.slides.entries',
            ],
        ];
    }

    /**
     * @throws Throwable
     */
    public function create(array $data): Page
    {
        try {
            DB::beginTransaction();

            $modelWithoutRelations = collect($data)
                ->except($this->straightRelations())
                ->toArray();

            $item = Page::create($modelWithoutRelations);

            $this->createRelationships($item, $data);

            DB::commit();

            return $item->load($this->straightRelations());
        } catch (Exception|Throwable $e) {
            DB::rollBack();

            throw $e;
        }
    }
}
