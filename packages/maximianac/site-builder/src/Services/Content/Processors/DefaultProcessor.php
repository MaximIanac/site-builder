<?php

namespace Maximianac\SiteBuilder\Services\Content\Processors;

use Illuminate\Support\Facades\Storage;
use InvalidArgumentException;
use Maximianac\SiteBuilder\Utility\Enums\ContentType;
use Maximianac\SiteBuilder\Utility\Enums\EntryType;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\FileBag;

class DefaultProcessor extends BaseProcessor
{
    /**
     * Update multiple content entries.
     *
     * @param array|null $data
     * @return void
     */
    public function updateMany(?array $data): void
    {
        if (isset($data)) {
            $this->setData($data);
        }

        foreach ($this->data as $entryData) {
            $this->updateOne($entryData, $this->files);
        }
    }

    /**
     * Process a single content entry based on its type.
     *
     * @param array $data Single entry data
     * @param FileBag|null $files Uploaded files bag
     * @return void
     */
    public function updateOne(array $data, FileBag $files = null): void
    {
        match (EntryType::tryFrom($data['type'])) {
            EntryType::File => $this->processFile($data),
            EntryType::Text => $this->processText($data),

            default => throw new InvalidArgumentException("Unsupported content type: {$data['type']}"),
        };
    }

    protected function processFile(array $data): void
    {
        $fileKey = "{$data['key']}_".ContentType::Default->value."_{$this->content->id}";

        if (!$this->files->has($fileKey)) {
            return;
        }

        /** @var UploadedFile $file */
        $file = $this->files->get($fileKey);

        $entry = $this->content->entries()->updateOrCreate(
            ['key' => $data['key']],
            ['type' => EntryType::File->value]
        );

        $path = Storage::disk('public')->putFileAs(
            'uploads', $file,uniqid() . '_' . $file->getClientOriginalName()
        );

        $entry->translations()->updateOrCreate(
            ['lang' => 'en'],
            [
                'value' => $path,
                'meta' => json_encode(['original_name' => $file->getClientOriginalName()])
            ]
        );
    }

    protected function processText(array $data): void
    {
        $entryModel = $this->content->entries()->updateOrCreate(
            ['key' => $data['key']],
            ['type' => $data['type'] ?? 'text']
        );

        if (isset($data['translations'])) {
            $translations = json_decode($data['translations'], true);

            $entryModel->syncTranslations($translations);
            return;
        }

        $entryModel->syncTranslations([
            ['lang' => 'en', 'value' => $data['value']]
        ]);
    }
}
