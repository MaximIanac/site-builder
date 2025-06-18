<?php

namespace Maximianac\SiteBuilder\Services\Modules\Reviews\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Maximianac\SiteBuilder\Services\Modules\Reviews\app\Models\Review;

class ReviewsController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'author_name' => 'required|string|max:100',
            'content' => 'required|string|max:1000',
        ]);

        Review::create($request->all());

        return back()->with('success', translate('reviews', 'store'));
    }

    public function destroy(Review $review): RedirectResponse
    {
        $review->delete();

        return back()->with('success', translate('reviews', 'destroy'));
    }
}
