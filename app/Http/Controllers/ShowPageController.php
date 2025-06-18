<?php

namespace App\Http\Controllers;

use Maximianac\SiteBuilder\Models\Page;

class ShowPageController extends Controller
{
    /**
     * Display the specified resource.
     */
    public function show(string|null $slug = null)
    {
        $slug = $slug ?? 'home';

        $page = Page::whereSlug($slug)->firstOrFail();

        if (!view()->exists("cp.content.pages.{$page->template}")) {
            abort(404, 'Template not found.');
        }

        return view("cp.content.pages.{$page->template}", ['page' => $page]);
    }
}
