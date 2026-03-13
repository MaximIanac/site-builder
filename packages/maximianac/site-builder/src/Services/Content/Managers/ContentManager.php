<?php

namespace Maximianac\SiteBuilder\Services\Content\Managers;

use Illuminate\Http\Request;
use Maximianac\SiteBuilder\Models\Page;

class ContentManager
{
    protected Request $request;
    protected Page $page;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function createPage(): ContentManager
    {
        $this->page = Page::create([
            'title' => $this->request->title,
            'slug' => $this->request->slug,
            'is_active' => $this->request->is_active,
        ]);

        return $this;
    }
}
