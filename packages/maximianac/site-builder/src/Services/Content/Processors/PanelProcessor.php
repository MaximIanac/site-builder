<?php

namespace Maximianac\SiteBuilder\Services\Content\Processors;

use Illuminate\Support\Facades\Storage;
use InvalidArgumentException;
use Maximianac\SiteBuilder\Models\Panel;
use Maximianac\SiteBuilder\Utility\Enums\ContentType;
use Maximianac\SiteBuilder\Utility\Enums\EntryType;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\FileBag;

class PanelProcessor extends BaseProcessor
{
    protected Panel $panel;

    /**
     * Update multiple content entries.
     *
     * @param array|null $data
     * @return void
     */
    public function updateMany(?array $data): void
    {
        if (isset($data)) {
            $this->setData(array_values($data));
        }

        foreach ($this->data as $index => $panel) {
            $this->updateOne($panel, $this->files, $index);
        }
    }

    /**
     * Process a single content entry based on its type.
     *
     * @param array $data Single entry data
     * @param FileBag|null $files Uploaded files bag
     * @param int $order
     * @return void
     */
    public function updateOne(array $data, FileBag $files = null, int $order = 0): void
    {
        $this->panel = Panel::find($data['id']);
        $this->panel->update(['order' => $order]);

        foreach ($data['fields'] as $fieldData) {
            match (EntryType::tryFrom($fieldData['type'])) {
                EntryType::File => $this->processFile($fieldData, $data['id']),
                EntryType::Text => $this->processText($fieldData),

                default => throw new InvalidArgumentException("Unsupported content type: {$fieldData['type']}"),
            };
        }
    }

    protected function processFile(array $data, int $parentId): void
    {
        $fileKey = "{$data['key']}_".ContentType::Panel->value."_{$parentId}";

        if (!$this->files->has($fileKey)) {
            return;
        }

        /** @var UploadedFile $file */
        $file = $this->files->get($fileKey);

        $field = $this->panel->fields()->updateOrCreate(
            ['key' => $data['key']],
            ['type' => EntryType::File->value]
        );

        $path = Storage::disk('public')->putFileAs(
            'uploads', $file,uniqid() . '_' . $file->getClientOriginalName()
        );

        $field->translations()->updateOrCreate(
            ['lang' => 'en'],
            [
                'value' => $path,
                'meta' => json_encode(['original_name' => $file->getClientOriginalName()])
            ]
        );
    }

    protected function processText(array $data): void
    {
        $fieldModel = $this->panel->fields()->updateOrCreate(
            ['key' => $data['key']],
            ['type' => $data['type'] ?? 'text']
        );

        if (isset($data['translations'])) {
            $translations = json_decode($data['translations'], true);

            $fieldModel->syncTranslations($translations);
            return;
        }

        $fieldModel->syncTranslations([
            ['lang' => 'en', 'value' => $data['value']]
        ]);
    }
}
