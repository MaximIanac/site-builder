<?php

namespace Maximianac\SiteBuilder\Http\Controllers\Content;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;
use Maximianac\SiteBuilder\Http\Requests\Content\Pages\StorePageRequest;
use Maximianac\SiteBuilder\Http\Requests\Content\Pages\UpdatePageRequest;
use Maximianac\SiteBuilder\Models\Page;
use Maximianac\SiteBuilder\Services\Content\Data\PageData;
use Maximianac\SiteBuilder\Services\Content\Managers\ContentManagerOld;
use Maximianac\SiteBuilder\Services\Content\Resources\PageResourceData;
use Maximianac\SiteBuilder\Services\Managers\Clients\Page\Adapters\PageDataAdapter;
use Maximianac\SiteBuilder\Services\Managers\Clients\Page\PageManager;
use Throwable;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('cp/pages/Index', [
            'pages' => Page::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('cp/pages/Create');

//        return view('cp.content.pages.create', [
//            'templates' => TemplateService::getPageTemplates()
//        ]);
    }

    /**
     * Store a newly created resource in storage.
     * @throws Throwable
     */
    public function store(StorePageRequest $request): RedirectResponse
    {
        $page = (new PageManager())->create(
            PageDataAdapter::make()->transform($request->validated())->toArray()
        );

        return redirect()->route('cp.pages.edit', $page);
    }

    /**
     * Display the specified resource.
     */
    public function show(Page $page)
    {
//        return view('cp.content.pages.edit', [
//            'page' => $page,
//            'templates' => TemplateService::getPageTemplates()
//        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Page $page)
    {
        return Inertia::render('cp/pages/Edit', [
            'page' => PageResourceData::from($page)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePageRequest $request, Page $page): RedirectResponse
    {
        $page = (new PageManager())->update(
            $page,
            PageDataAdapter::make()->transform($request->validated())->toArray()
        );

        return redirect()->route('cp.pages.edit', $page);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
