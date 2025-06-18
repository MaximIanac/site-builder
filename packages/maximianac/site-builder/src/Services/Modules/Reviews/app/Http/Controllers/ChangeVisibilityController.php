<?php

namespace Maximianac\SiteBuilder\Services\Modules\Reviews\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Maximianac\SiteBuilder\Services\Modules\Reviews\app\Models\Review;

class ChangeVisibilityController extends Controller
{
    public function changeVisibility(Request $request, Review $review): RedirectResponse
    {
        $request->validate([
            'is_visible' => 'required|boolean',
        ]);

        $review->update($request->only('is_visible'));

        return redirect()->route('admin.reviews.index')
            ->with('success', translate('reviews', 'update'));
    }
}
