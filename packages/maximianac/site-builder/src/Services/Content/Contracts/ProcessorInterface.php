<?php

namespace Maximianac\SiteBuilder\Services\Content\Contracts;

use Maximianac\SiteBuilder\Models\Content;
use Symfony\Component\HttpFoundation\FileBag;

interface ProcessorInterface
{
    public function setContent(Content $content): ProcessorInterface;
    public function setFiles(FileBag $files): ProcessorInterface;
    public function setData(array $data): ProcessorInterface;
    public function self(): ProcessorInterface;
    public function updateMany(?array $data): void;
    public function updateOne(array $data): void;
}
