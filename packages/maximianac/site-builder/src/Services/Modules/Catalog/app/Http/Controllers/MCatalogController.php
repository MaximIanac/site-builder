<?php

namespace Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MCatalogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return Inertia::render("cp/modules/catalog/Index", [
            'pageData' => app(config("site-builder.modules.catalog.components.providers.data"))::handle($request),
        ]);
    }
}
