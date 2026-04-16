<?php

namespace Maximianac\SiteBuilder\Services\Managers\Traits;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;
use Symfony\Component\HttpFoundation\File\UploadedFile;

trait HasRelations
{
    protected function getMediaLibrary(): string
    {
        return 'media';
    }

    protected function straightRelations(): array
    {
        return [];
    }

    protected function nestedRelations(): array
    {
        return [];
    }

    /**
     * @throws Exception
     */
    protected function createRelationships(Model $item, array $data): void
    {
        foreach ($this->straightRelations() as $relation) {
            if (!isset($data[$relation])) {
                continue;
            }

            if (!method_exists($item, $relation)) {
                throw new Exception("Relation {$relation} on model does not exist");
            }

            $values = $data[$relation];

            if (is_array($values) && array_is_list($values)) {
                foreach ($values as $value) {
                    $this->createRelationWithChildren($item, $relation, $value);
                }
            } else {
                $item->$relation()->create($values);
            }
        }
    }

    private function createRelationWithChildren(
        Model $parent,
        string $straightRelation,
        array $data,
        string $currNestedRelation = '',
        string $nextNestedRelation = ''
    ): Model {
        $nextRelation = $nextNestedRelation ?: $this->getNextNestedRelation($straightRelation);
        $currRelation = $currNestedRelation ?: $straightRelation;

        $modelData = $data;
        unset($modelData[$nextRelation]);

        $files = [];
        $this->extractFiles($modelData, $files);
        $child = $parent->$currRelation()->create($modelData);

        if (count($files) > 0) {
            $this->saveFiles($child, $files);
        }

        if (isset($data[$nextRelation]) && $data[$nextRelation]) {
            $nestedItems = array_is_list($data[$nextRelation])
                ? $data[$nextRelation]
                : [$data[$nextRelation]];

            foreach ($nestedItems as $nestedItem) {
                $this->createRelationWithChildren(
                    $child,
                    $straightRelation,
                    $nestedItem,
                    $nextRelation,
                    Str::of($this->getNextNestedRelation($straightRelation, $nextRelation))
                        ->afterLast('.')
                );
            }
        }

        return $child;
    }

    /**
     * @throws Exception
     */
    protected function updateRelationships(Model $item, array $data): void
    {
        foreach ($this->straightRelations() as $relation) {
            if (!isset($data[$relation])) {
                continue;
            }

            if (!method_exists($item, $relation)) {
                throw new Exception("Relation {$relation} on model does not exist");
            }

            $values = $data[$relation];
            $relationQuery = $item->$relation();

            $existingIds = $relationQuery->pluck('id')->toArray();
            $incomingIds = [];

            if (is_array($values) && array_is_list($values)) {
                foreach ($values as $value) {
                    if (isset($value['id'])) {
                        $incomingIds[] = $value['id'];

                        $this->updateRelationWithChildren($item, $relation, $value);

                        continue;
                    }

                    $this->createRelationWithChildren($item, $relation, $value);
                }
//            } else {
//                $relationQuery->update($values);
            }

            $toDelete = array_diff($existingIds, $incomingIds);
            if (!empty($toDelete)) {
                $relationQuery->whereIn('id', $toDelete)->delete();
            }
        }
    }

    private function updateRelationWithChildren(
        Model $parent,
        string $straightRelation,
        array $data,
        string $currNestedRelation = '',
        string $nextNestedRelation = ''
    ): Model {
        $nextRelation = $nextNestedRelation ?: $this->getNextNestedRelation($straightRelation);
        $currRelation = $currNestedRelation ?: $straightRelation;

        $modelData = $data;
        unset($modelData[$nextRelation]);

        $files = [];
        $this->extractFiles($modelData, $files);

        if ($modelData['id']) {
            $child = $parent->$currRelation()->find($modelData['id']);
            $child->update($modelData);
        } else {
            $child = $parent->$currRelation()->create($modelData);
        }

        $this->saveFiles($child, $files);

        if (isset($data[$nextRelation]) && $data[$nextRelation]) {
            $nestedItems = array_is_list($data[$nextRelation])
                ? $data[$nextRelation]
                : [$data[$nextRelation]];

            $relationQuery = $child->$nextRelation();
            $existingIds = $relationQuery->pluck('id')->toArray();
            $incomingIds = [];

            foreach ($nestedItems as $nestedItem) {
                if (isset($nestedItem['id'])) {
                    $incomingIds[] = $nestedItem['id'];

                    $this->updateRelationWithChildren(
                        $child,
                        $straightRelation,
                        $nestedItem,
                        $nextRelation,
                        Str::of($this->getNextNestedRelation($straightRelation, $nextRelation))
                            ->afterLast('.')
                    );

                    continue;
                }

                $this->createRelationWithChildren(
                    $child,
                    $straightRelation,
                    $nestedItem,
                    $nextRelation,
                    Str::of($this->getNextNestedRelation($straightRelation, $nextRelation))
                        ->afterLast('.')
                );
            }

            $toDelete = array_diff($existingIds, $incomingIds);
            if (!empty($toDelete)) {
                $relationQuery->whereIn('id', $toDelete)->delete();
            }
        }

        return $child;
    }

    private function getNextNestedRelation(string $relation, string $currNestedRelation = ''): ?string
    {
        $goalIndex = null;
        foreach ($this->nestedRelations()[$relation] as $index => $path) {
            if ($path === $currNestedRelation) {
                $goalIndex = $index + 1;
            }
        }

        if (is_null($goalIndex)) {
            return $this->nestedRelations()[$relation][0];
        }

        if (isset($this->nestedRelations()[$relation][$goalIndex])) {
            return $this->nestedRelations()[$relation][$goalIndex];
        }

        return null;
    }

    /**
     * Extracts UploadedFile instances from data (recursively) and removes them.
     *
     * @param array $data
     * @param array $files
     */
    private function extractFiles(array &$data, array &$files = []): void
    {
        foreach ($data as $key => &$value) {
            if ($value instanceof UploadedFile) {
                $files[] = $value;
                unset($data[$key]);
                continue;
            }

            if (is_array($value) && isset($value['file']) && $value['file'] instanceof UploadedFile) {
                $files[] = $value['file'];
                unset($data[$key]);
                continue;
            }

            if (is_array($value)) {
                $this->extractFiles($value, $files);
            }
        }
    }

    /**
     * Saves UploadedFile instances to the model media collection.
     *
     * @param Model $model
     * @param array $files
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    private function saveFiles(Model $model, array $files): void
    {
        if (!$model instanceof HasMedia) {
            return;
        }

        $isSingle = $this->isSingleCollection($model);
        $collection = $this->getMediaLibrary();

        if ($isSingle && empty($files)) {
            $model->clearMediaCollection($collection);
            return;
        }

        foreach ($files as $index => $file) {
            $model
                ->addMedia($file)
                ->toMediaCollection($collection)
                ->update(['order_column' => $index + 1]);
        }
    }

    private function isSingleCollection(Model $model): bool
    {
        return $model->getMediaCollection($this->getMediaLibrary())?->singleFile === true;
    }

    private function handleMedia(Model $model, array $data): void
    {
        foreach ($data as $value) {
            if ($value instanceof UploadedFile) {
                $model
                    ->addMedia($value)
                    ->toMediaCollection($this->getMediaLibrary());

                continue;
            }

            if (isset($value['file']) && $value['file'] instanceof UploadedFile) {
                $model
                    ->addMedia($value['file'])
                    ->toMediaCollection($this->getMediaLibrary());

                continue;
            }

            if (is_array($value)) {
                $this->handleMedia($model, $value);
            }
        }
    }
}
