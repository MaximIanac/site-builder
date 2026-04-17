<?php

namespace Maximianac\SiteBuilder\Services\Managers\Traits;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use InvalidArgumentException;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use UnexpectedValueException;

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

    /**
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
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
            $this->processingFiles($child, $files);
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

    /**
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
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

        $this->processingFiles($child, $files);

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
            if (is_array($value) && isset($value['file']) && $value['file'] instanceof UploadedFile) {
                $files[] = $value;
                unset($data[$key]);
                continue;
            }

            if (is_array($value) && isset($value['uuid']) && isset($value['action'])) {
                $files[] = $value;
                unset($data[$key]);
                continue;
            }

//            if (is_array($value)) {
//                $this->extractFiles($value, $files);
//            }
        }
    }

    /**
     * Processing files by their actions (DELETED, NEW, EXISTING).
     *
     * @param Model $model
     * @param array $files
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    private function processingFiles(Model $model, array $files): void
    {
        if (!$model instanceof HasMedia) {
            return;
        }

        $isSingle = $this->isSingleCollection($model);
        $collection = $this->getMediaLibrary();

        /** Deleting files */
        $deletedFiles = array_filter(
            $files,
            fn ($file) => ($file['action'] ?? null) === "deleted"
        );

        foreach ($deletedFiles as $file) {
            if (!empty($file['id'])) {
                Media::find($file['id'])?->delete();
            }
        }

        /** @var array $files Only EXISTING and NEW files */
        $files = array_values(array_filter($files, function ($file) {
            return ($file['action'] ?? null) !== 'deleted';
        }));

        /** Processing NEW and EXISTING files */
        foreach ($files as $index => $file) {
            $action = $file['action'] ?? null;

            switch ($action) {
                case 'new':
                    $uploaded = $model
                        ->addMedia($file['file'])
                        ->toMediaCollection($collection);

                    $uploaded->order_column = $index + 1;
                    $uploaded->save();

                    break;

                case 'existing':
                    if ($isSingle) {
                        break;
                    }

                    $media = Media::firstWhere('uuid', $file['uuid']);

                    if (!$media) {
                        break;
                    }

                    if ($media->model_id !== $model->getKey()) {
                        $media->model()->associate($model);
                    }

                    $media->order_column = $index + 1;
                    $media->save();

                    break;

                default:
                    throw new UnexpectedValueException(
                        "Unknown media action: {$action}"
                    );
            }
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
