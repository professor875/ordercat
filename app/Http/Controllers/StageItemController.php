<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Stage;
use App\Models\StageItem;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class StageItemController extends Controller
{
    public function updateRating(Request $request, Stage $stage, Item $item)
    {
        $request->validate([
            'rating' => ['required', 'string', Rule::in(config('constants.rating'))],
        ]);

        $stage->items()->updateExistingPivot($item->id, ['item_rating' => $request->rating]);

        return back()->with('success', 'Rating updated!');
    }
}
