<?php

namespace Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Maximianac\SiteBuilder\Http\Requests\Content\UpdatePageRequest;
use Maximianac\SiteBuilder\Models\Page;
use Maximianac\SiteBuilder\Services\Modules\Catalog\app\Data\MCatalogCategoryData;
use Maximianac\SiteBuilder\Services\Modules\Catalog\app\Data\Product\MCatalogProductData;
use Maximianac\SiteBuilder\Services\Modules\Catalog\app\Data\Product\MCatalogProductPropertyData;
use Maximianac\SiteBuilder\Services\Modules\Catalog\app\Enums\CurrencyEnum;
use Maximianac\SiteBuilder\Services\Modules\Catalog\app\Enums\PropertyUsageTypeEnum;
use Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Requests\Category\MCatalogCategoryStoreRequest;
use Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Requests\Category\MCatalogCategoryUpdateRequest;
use Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Requests\Product\MCatalogProductStoreRequest;
use Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Requests\Product\MCatalogProductUpdateRequest;
use Maximianac\SiteBuilder\Services\Modules\Catalog\app\Models\MCatalogCategory;
use Maximianac\SiteBuilder\Services\Modules\Catalog\app\Models\MCatalogCurrency;
use Maximianac\SiteBuilder\Services\Modules\Catalog\app\Models\MCatalogProduct;
use Maximianac\SiteBuilder\Services\Modules\Catalog\app\Models\MCatalogProductProperty;
use Spatie\LaravelData\PaginatedDataCollection;

class MCatalogProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('cp.content.modules.catalog.products.index', [
            'products' => MCatalogProductData::collect(
                MCatalogProduct::query()->paginate(20),
                PaginatedDataCollection::class
            ),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('cp.content.modules.catalog.products.create', [
            'categories' => MCatalogCategoryData::collect(
                MCatalogCategory::all(),
            ),
//            'category_properties' => MCatalogProductPropertyData::collect(MCatalogProductProperty::forCategory()->get()),
            'offer_properties' => MCatalogProductPropertyData::collect(MCatalogProductProperty::forOffer()->get()),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MCatalogProductStoreRequest $request): RedirectResponse
    {
        DB::transaction(function () use ($request) {
            $validated = $request->validated();

            $product = MCatalogProduct::create([
                'name' => $validated['name'],
                'slug' => Str::slug($validated['slug']),
                'category_id' => $validated['category_id'],
                'short_description' => $validated['short_description'],
                'description' => $validated['description'],
            ]);

            if ($request->has('properties')) {
                foreach ($request->input('properties') as $id => $value) {
                    $product->properties()->sync([$id => ['value' => $value]]);
                }
            }

            $offers = json_decode($request->input('offers'), true);


            $currency = MCatalogCurrency::whereCode(CurrencyEnum::MDL)->first();
            foreach ($offers as $offerData) {
                $offer = $product->offers()->create([
                    'sku' => $offerData['sku'],
                    'quantity' => $offerData['stock']
                ]);

                $offer->currencies()->syncWithoutDetaching([
                    $currency->id => ['price' => $offerData['price']]
                ]);

                foreach ($offerData['properties'] as $property) {
                    $offer->properties()->sync([
                        $property['id'] => ['value' => $property['value']]
                    ]);
                }
            }

            if ($request->hasFile('media')) {
                $metas = json_decode($request->input('media_meta', []), true);
                $metas = array_merge(...$metas);

                foreach ($request->file('media') as $file) {
                    $product
                        ->addMedia($file)
                        ->withCustomProperties($metas[$file->getClientOriginalName()])
                        ->toMediaCollection('images');
                }
            }
        });

        return redirect()->back()->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(MCatalogProduct $product)
    {
        return view('cp.content.modules.catalog.products.show', [
            'product' => MCatalogProductData::from($product->load(['offers'])),
            'properties' => MCatalogProductPropertyData::collect(MCatalogProductProperty::all()),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MCatalogProduct $product)
    {
        return view('cp.content.modules.catalog.products.edit', [
            'product' => MCatalogProductData::from($product),
            'categories' => MCatalogCategoryData::collect(
                MCatalogCategory::all(),
            ),
            'offer_properties' => MCatalogProductPropertyData::collect(MCatalogProductProperty::forOffer()->get()),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MCatalogProductUpdateRequest $request, MCatalogProduct $product): RedirectResponse
    {
        DB::transaction(function () use ($request, $product) {
            $validated = $request->validated();

            $product->update([
                'name' => $validated['name'],
                'slug' => Str::slug($validated['slug']),
                'category_id' => $validated['category_id'],
                'short_description' => $validated['short_description'],
                'description' => $validated['description'],
            ]);

            if ($request->has('properties')) {
                foreach ($request->input('properties') as $id => $value) {
                    if (is_null($value)) {
                        continue;
                    }

                    $product->properties()->sync([$id => ['value' => $value]], false);
                }
            }

            $offers = json_decode($request->input('offers'), true);

            $currency = MCatalogCurrency::whereCode(CurrencyEnum::MDL)->first();
            foreach ($offers as $offerData) {
                $offer = $product->offers()->updateOrCreate(
                    ['sku' => $offerData['sku']],
                    ['quantity' => $offerData['stock']]
                );

                $offer->currencies()->syncWithoutDetaching([
                    $currency->id => ['price' => $offerData['price']]
                ]);

                foreach ($offerData['properties'] as $property) {
                    $offer->properties()->sync([
                        $property['id'] => ['value' => $property['value']]
                    ]);
                }
            }

//            dd($request);

            $metas = json_decode($request->input('media_meta', []), true);
            $metas = array_merge(...$metas);

            if ($request->hasFile('media')) {
                foreach ($request->file('media') as $file) {
                    $product
                        ->addMedia($file)
                        ->withCustomProperties($metas[$file->getClientOriginalName()])
                        ->toMediaCollection('images');
                }
            }

            $mediaDeletedIds = json_decode($request->input('media_deleted_ids', []));

            foreach ($mediaDeletedIds as $mediaId) {
                $product->deleteMedia($mediaId);
            }

            foreach ($product->images as $image) {
                if (isset($metas[$image->file_name])) {
                    $image->custom_properties = $metas[$image->file_name];
                    $image->save();
                }
            }

        });

        return redirect()->route('cp.content.modules.catalog.products.edit', $product->slug)->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
