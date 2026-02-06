<?php

namespace Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Maximianac\SiteBuilder\Services\Modules\Catalog\app\Data\MCatalogCategoryData;
use Maximianac\SiteBuilder\Services\Modules\Catalog\app\Data\MCatalogPropertyData;
use Maximianac\SiteBuilder\Services\Modules\Catalog\app\Data\Product\MCatalogProductData;
use Maximianac\SiteBuilder\Services\Modules\Catalog\app\Data\Product\MCatalogProductVariantData;
use Maximianac\SiteBuilder\Services\Modules\Catalog\app\Enums\CurrencyEnum;
use Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Requests\Product\MCatalogProductStoreRequest;
use Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Requests\Product\MCatalogProductUpdateRequest;
use Maximianac\SiteBuilder\Services\Modules\Catalog\app\Models\MCatalogCategory;
use Maximianac\SiteBuilder\Services\Modules\Catalog\app\Models\MCatalogCurrency;
use Maximianac\SiteBuilder\Services\Modules\Catalog\app\Models\MCatalogProduct;
use Maximianac\SiteBuilder\Services\Modules\Catalog\app\Models\MCatalogProperty;
use Maximianac\SiteBuilder\Services\Modules\Catalog\app\Models\MCatalogVariant;
use Spatie\LaravelData\PaginatedDataCollection;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

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
        return Inertia::render('cp/modules/catalog/products/Create', [
            'categories' => MCatalogCategoryData::collect(
                MCatalogCategory::all(),
            )
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
                'slug' => Str::slug($validated['slug']),
                'category_id' => $validated['category_id'],
                'name' => $validated['name'],
                'short_description' => $validated['short_description'],
                'description' => $validated['description'],
            ]);

            if ($request->has('properties')) {
                $product->properties()->sync(
                    collect($validated['properties'])
                        ->keyBy('id')
                        ->map(fn ($property) => [
                            'value' => json_encode($property['value']),
                            'origin' => 'category',
                        ])
                        ->toArray()
                );
            }

            $currency = MCatalogCurrency::whereCode(CurrencyEnum::MDL)->first();

            /** @var MCatalogVariant $variant */
            foreach ($validated['variants'] as $variantData) {
                $variant = $product->variants()->create([
                    'sku' => $variantData['sku'],
                    'quantity' => $variantData['quantity'],
                ]);

                $variant->currencies()->sync([
                    $currency->id => ['price' => $variantData['price']]
                ]);

                if (isset($variantData['properties'])) {
                    $variant->properties()->sync(
                        collect($variantData['properties'])
                            ->keyBy('id')
                            ->map(fn ($property) => [
                                'value' => json_encode($property['value']),
                                'origin' => 'variant',
                            ])
                            ->toArray()
                    );
                }
            }

            if ($request->hasFile('media')) {
                foreach ($request->file('media') as $file) {
                    $product
                        ->addMedia($file)
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
            'product' => MCatalogProductData::from($product->load(['variant'])),
            'properties' => MCatalogPropertyData::collect(MCatalogProperty::all()),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MCatalogProduct $product)
    {
        return Inertia::render('cp/modules/catalog/products/Edit', [
            'product' => MCatalogProductData::from($product->load('properties')),
            'categories' => MCatalogCategoryData::collect(
                MCatalogCategory::all(),
            ),
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
                'slug' => Str::slug($validated['slug']),
                'category_id' => $validated['category_id'],
                'name' => $validated['name'],
                'short_description' => $validated['short_description'],
                'description' => $validated['description'],
            ]);

            if ($request->has('properties')) {
                $product->properties()->sync(
                    collect($validated['properties'])
                        ->keyBy('id')
                        ->map(fn ($property) => [
                            'value' => $property['value'],
                            'origin' => 'category',
                        ])
                        ->toArray()
                );
            }

            $currency = MCatalogCurrency::whereCode(CurrencyEnum::MDL)->first();

            /** @var MCatalogVariant $variant */
            foreach ($validated['variants'] as $variantData) {
                $variantModel = MCatalogVariant::whereSku($variantData['sku'])->first();

                if ($variantModel) {
                    $variantModel->update([
                        'quantity' => $variantData['quantity'],
                    ]);

                    $variantModel->currencies()->sync([
                        $currency->id => ['price' => $variantData['price']]
                    ]);

                    if (isset($variantData['properties'])) {
                        $variantModel->properties()->sync(
                            collect($variantData['properties'])
                                ->keyBy('id')
                                ->map(fn ($property) => [
                                    'value' => $property['value'],
                                    'origin' => 'variant',
                                ])
                                ->toArray()
                        );
                    }

                    continue;
                }

                $variant = $product->variants()->create([
                    'sku' => $variantData['sku'],
                    'quantity' => $variantData['quantity'],
                ]);

                $variant->currencies()->sync([
                    $currency->id => ['price' => $variantData['price']]
                ]);

                $variant->properties()->sync(
                    collect($variantData['properties'])
                        ->keyBy('id')
                        ->map(fn ($property) => [
                            'value' => $property['value'],
                            'origin' => 'variant',
                        ])
                        ->toArray()
                );

            }

            foreach ($request->input('media') as $index => $media) {
                if (!empty($media['_destroy'])) {
                    $product->deleteMedia($media['id']);
                    continue;
                }

                if (!empty($media['isExisting'])) {
                    $mediaModel = $product->media()->whereKey($media['id'])->first();
                    $mediaModel->order_column = $index + 1;
                    $mediaModel->save();

                    continue;
                }

                if ($request->hasFile("media.$index.file")) {
                    $product
                        ->addMedia($request->file("media.$index.file"))
                        ->toMediaCollection('images');
                }
            }
        });

        return redirect()->back()->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
