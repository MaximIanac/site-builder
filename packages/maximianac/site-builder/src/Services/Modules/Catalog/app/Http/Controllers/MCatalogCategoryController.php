<?php

namespace Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Maximianac\SiteBuilder\Http\Requests\Content\UpdatePageRequest;
use Maximianac\SiteBuilder\Models\Page;
use Maximianac\SiteBuilder\Services\Modules\Catalog\app\Data\MCatalogCategoryData;
use Maximianac\SiteBuilder\Services\Modules\Catalog\app\Data\Product\MCatalogProductData;
use Maximianac\SiteBuilder\Services\Modules\Catalog\app\Data\Product\MCatalogProductPropertyData;
use Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Requests\Category\MCatalogCategoryStoreRequest;
use Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Requests\Category\MCatalogCategoryUpdateRequest;
use Maximianac\SiteBuilder\Services\Modules\Catalog\app\Models\MCatalogCategory;
use Maximianac\SiteBuilder\Services\Modules\Catalog\app\Models\MCatalogProductProperty;

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
        return view('cp.content.modules.catalog.categories.create', [
            'categories' => MCatalogCategoryData::collect(
                MCatalogCategory::all(),
            ),
            'properties' => MCatalogProductPropertyData::collect(
                MCatalogProductProperty::all()
            ),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MCatalogCategoryStoreRequest $request): RedirectResponse
    {
//        dd($request);
        $validated = $request->validated();

        $category = MCatalogCategory::create([
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name']['en']),
            'description' => $validated['description'] ?? null,
            'parent_id' => $validated['parent_id'] ?? null,
        ]);

        $category->properties()->sync(array_merge(
            $validated['inherited_properties'] ?? [],
            $validated['added_properties'] ?? []
        ));

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

        return view('cp.content.modules.catalog.categories.edit', [
            'categories' => MCatalogCategoryData::collect(
                MCatalogCategory::where('slug', '!=', $category->slug)->get(),
            ),
            'properties' => MCatalogProductPropertyData::collect(
                MCatalogProductProperty::all()
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

        $category->update([
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name']['en']),
            'description' => $validated['description'],
            'parent_id' => $validated['parent_id'] ?? null,
        ]);

        $category->properties()->sync(array_merge(
            $validated['inherited_properties'] ?? [],
            $validated['added_properties'] ?? []
        ));

        return redirect()->route('cp.content.modules.catalog.categories.show', $category->slug)->with('success', 'Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
