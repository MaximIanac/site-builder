<?php

namespace App\Http\Controllers\ControlPanel\Content\Modules;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Maximianac\SiteBuilder\Data\Content\ContentBlockData;
use Maximianac\SiteBuilder\Http\Requests\Content\UpdatePageRequest;
use Maximianac\SiteBuilder\Models\Module;
use Maximianac\SiteBuilder\Models\Page;
use Maximianac\SiteBuilder\Services\Content\Managers\ContentManagerOld;
use Maximianac\SiteBuilder\Services\Modules\Catalog\app\Data\MCatalogDataProvider;
use Maximianac\SiteBuilder\Services\Modules\Core\Template\TemplateService;

class ModulesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('cp.content.modules.index', [
            'modules' => Module::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
//        return view('cp.content.pages.create', [
//            'templates' => TemplateService::getPageTemplates()
//        ]);
    }

    /**
     * Store a newly created resource in storage.
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
//        $request->validate([
//            'title' => 'required|string|max:255',
//            'slug' => 'nullable|string|max:255|unique:pages,slug',
//            'template' => 'required|string',
//        ]);
//
//        $slug = $request->slug ?? Str::slug($request->title);
//
//        if (Page::where('slug', $slug)->exists()) {
//            throw ValidationException::withMessages([
//                'slug' => 'This slug is already taken. Please choose another one.',
//            ]);
//        }
//
//        $page = Page::create([
//            'title' => $request->title,
//            'slug' => $slug,
//            'template' => $request->template,
//        ]);
//
//        return redirect()->route('cp.content.pages.edit', $page)->with('success', 'Page created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, string|null $slug = null)
    {
//        $module = Module::whereName($slug)->firstOrFail();
//
//        try {
//            return Inertia::render("сp/сontent/Modules/{$module->name}/Show", [
//                'module' => $module,
//                'data' => app(config("site-builder.modules.{$module->name}.components.providers.data"))::handle($request),
//            ]);
//        } catch (\Throwable $e) {
//            abort(404, 'Template not found.');
//        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Page $page)
    {
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
//
////        dd($request->input('content', []));
//        foreach ($request->input('content', []) as $content) {
//            ContentManagerOld::from($page, $content['key'], $content['type'])
//                ->processor($request->files)
//                ->updateMany($content['data']);
//        }
//
//        $page->update($request->only(['title', 'slug', 'template']));
//
//        return redirect()->route('cp.content.pages.edit', $page)->with('success', 'Page edited successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
