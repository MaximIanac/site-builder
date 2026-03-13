<?php

namespace Maximianac\SiteBuilder\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Maximianac\SiteBuilder\Data\Content\ContentBlockData;
use Maximianac\SiteBuilder\Http\Requests\Content\UpdatePageRequest;
use Maximianac\SiteBuilder\Http\Requests\Pages\PageStoreRequest;
use Maximianac\SiteBuilder\Models\Page;
use Maximianac\SiteBuilder\Services\Content\Data\PageData;
use Maximianac\SiteBuilder\Services\Content\Managers\ContentManagerOld;
use Maximianac\SiteBuilder\Services\Managers\Clients\Page\Adapters\PageDataAdapter;
use Maximianac\SiteBuilder\Services\Managers\Clients\Page\PageManager;
use Maximianac\SiteBuilder\Services\Modules\Core\Template\TemplateService;
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
    public function store(PageStoreRequest $request): RedirectResponse
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
            'page' => PageData::from($page)
        ]);

//        return view('cp.content.pages.edit', [
//            'page' => $page,
//            'contents' => ContentBlockData::collect($page->contents),
//            'templates' => TemplateService::getPageTemplates()
//        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePageRequest $request, Page $page): RedirectResponse
    {
        // TODO: ДОДЕЛАТЬ ПРОЦЕССОР ДЛЯ PANELS

//        dd($request->input('content', []));
        foreach ($request->input('content', []) as $content) {
            ContentManagerOld::from($page, $content['key'], $content['type'])
                ->processor($request->files)
                ->updateMany($content['data']);
        }

        $page->update($request->only(['title', 'slug', 'template']));

        return redirect()->route('cp.content.pages.edit', $page)->with('success', 'Page edited successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
