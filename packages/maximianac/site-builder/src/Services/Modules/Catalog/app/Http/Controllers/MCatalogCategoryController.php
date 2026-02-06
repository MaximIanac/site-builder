<?php

namespace Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Maximianac\SiteBuilder\Services\Modules\Catalog\app\Data\MCatalogCategoryData;
use Maximianac\SiteBuilder\Services\Modules\Catalog\app\Data\MCatalogPropertyData;
use Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Requests\Category\MCatalogCategoryStoreRequest;
use Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Requests\Category\MCatalogCategoryUpdateRequest;
use Maximianac\SiteBuilder\Services\Modules\Catalog\app\Models\MCatalogCategory;
use Maximianac\SiteBuilder\Services\Modules\Catalog\app\Models\MCatalogProperty;

class MCatalogCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('cp.content.modules.catalog.categories.index', [
            'rootCategories' => MCatalogCategoryData::collect(
                MCatalogCategory::whereNull('parent_id')->with(['allChildren'])->get()
            ),
            'allCategories' => MCatalogCategoryData::collect(
                MCatalogCategory::whereNotNull('parent_id')->with(['parent', 'allChildren'])->get()
            ),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('cp/modules/catalog/categories/Create', [
            'categories' => MCatalogCategoryData::collect(
                MCatalogCategory::all(),
            ),
            'properties' => MCatalogPropertyData::collect(
                MCatalogProperty::all()
            ),
        ]);

//        return view('cp.content.modules.catalog.categories.create', [
//            'categories' => MCatalogCategoryData::collect(
//                MCatalogCategory::all(),
//            ),
//            'properties' => MCatalogPropertyData::collect(
//                MCatalogProperty::all()
//            ),
//        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MCatalogCategoryStoreRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        DB::transaction(function () use ($validated) {
            $category = MCatalogCategory::create([
                'name' => $validated['locales']['name'],
                'slug' => Str::slug($validated['locales']['name']['en']),
                'description' => $validated['locales']['description'] ?? null,
                'parent_id' => $validated['parent_id'] ?? null,
            ]);

            $category->properties()->sync(array_merge(
                $validated['inherited_properties'] ?? [],
                $validated['added_properties'] ?? []
            ));
        });

        return redirect()->back()->with('success', 'Category created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(MCatalogCategory $category)
    {
        $category->load(['properties', 'parent', 'allChildren']);

        $products = $category->products()
            ->orderBy('created_at', 'desc')
            ->paginate();

        return view('cp.content.modules.catalog.categories.show', [
            'category' => $category,
            'products' => $products,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MCatalogCategory $category)
    {
        $category->load(['parent', 'properties']);

        return Inertia::render('cp/modules/catalog/categories/Edit', [
            'categories' => MCatalogCategoryData::collect(
                MCatalogCategory::where('slug', '!=', $category->slug)->get(),
            ),
            'properties' => MCatalogPropertyData::collect(
                MCatalogProperty::all()
            ),
            'category' => MCatalogCategoryData::from($category, ['translatable' => $category->translations]),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MCatalogCategoryUpdateRequest $request, MCatalogCategory $category): RedirectResponse
    {
        $validated = $request->validated();

        DB::transaction(function () use ($category, $validated) {
            $category->update([
                'name' => $validated['locales']['name'],
                'slug' => Str::slug($validated['locales']['name']['en']),
                'description' => $validated['locales']['description'] ?? null,
                'parent_id' => $validated['parent_id'] ?? null,
            ]);

            $category->properties()->sync(array_merge(
                $validated['inherited_properties'] ?? [],
                $validated['added_properties'] ?? []
            ));
        });

        return redirect()->route('cp.modules.catalog.categories.edit', $category->slug);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
