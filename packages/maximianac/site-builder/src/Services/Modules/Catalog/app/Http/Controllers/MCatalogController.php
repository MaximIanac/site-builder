<?php

namespace Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Inertia\Inertia;
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

class MCatalogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return Inertia::render("cp/content/modules/catalog/Index", [
            'pageData' => app(config("site-builder.modules.catalog.components.providers.data"))::handle($request),
        ]);
    }
}
