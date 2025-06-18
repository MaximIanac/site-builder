<?php

namespace Maximianac\SiteBuilder\Services\Content\Processors;

use Maximianac\SiteBuilder\Models\Content;
use Maximianac\SiteBuilder\Services\Content\Contracts\ProcessorInterface;
use Symfony\Component\HttpFoundation\FileBag;

abstract class BaseProcessor implements ProcessorInterface
{
    protected Content $content;
    protected FileBag $files;
    protected array $data;

    public function setContent(Content $content): BaseProcessor
    {
        $this->content = $content;

        return $this;
    }

    public function setData(array $data): BaseProcessor
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Set the uploaded files for processing.
     *
     * @param FileBag $files The bag of uploaded files
     * @return self
     */
    public function setFiles(FileBag $files): BaseProcessor
    {
        $this->files = $files;

        return $this;
    }

    public function self(): BaseProcessor
    {
        return $this;
    }

}
