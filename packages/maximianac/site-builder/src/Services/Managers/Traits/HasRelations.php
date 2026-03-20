<?php

namespace Maximianac\SiteBuilder\Services\Managers\Traits;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

trait HasRelations
{
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

        $child = $parent->$currRelation()->create($modelData);

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

        if ($modelData['id']) {
            $child = $parent->$currRelation()->find($modelData['id']);
            $child->update($modelData);
        } else {
            $child = $parent->$currRelation()->create($modelData);
        }

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
}
