<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;

class ReviewController extends Controller
{
    public function store(Request $request, $item_id)
    {
        $request->validate([
            'Rating' => 'required|integer|min:1|max:5',
            'Comment' => 'required|string|max:1000',
        ]);

        Review::create([
            'Item_id' => $item_id,
            'Customer_id' => auth()->id(),
            'Rating' => $request->Rating,
            'Comment' => $request->Comment,
            'Date' => now(),
        ]);

        return back()->with('success', 'Дякуємо! Ваш відгук успішно додано.');
    }
}