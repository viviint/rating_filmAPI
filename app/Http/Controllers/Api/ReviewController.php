<?php

namespace App\Http\Controllers\Api;

use App\Models\Review;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReviewController extends Controller
{

    public function index()
    {
        $reviews = Review::all();

        return response()->json([
            'status' => 'success',
            'data' => $reviews
        ]);
    }

    public function show($id)
    {
        $review = Review::find($id);

        if (!$review) {
            return response()->json([
                'status' => 'error',
                'message' => 'Review not found'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $review
        ]);
    }

   public function store(Request $request)
{
    $review = new Review();
    $review->movie_title = $request->movie_title;
    $review->reviewer_name = $request->reviewer_name;
    $review->rating = $request->rating;
    $review->comment = $request->comment;
    $review->save();

    return response()->json([
        'status' => 'success',
        'message' => 'Review created',
        'data' => $review
    ], 201);
}

    public function update(Request $request, $id)
    {
        $review = Review::find($id);

        if (!$review) {
            return response()->json([
                'status' => 'error',
                'message' => 'Review not found'
            ], 404);
        }

        $request->validate([
            'movie_title' => 'sometimes|required',
            'reviewer_name' => 'sometimes|required',
            'rating' => 'sometimes|required|integer|min:1|max:5',
            'comment' => 'nullable'
        ]);

        $review->update($request->only([
            'movie_title',
            'reviewer_name',
            'rating',
            'comment'
        ]));

        return response()->json([
            'status' => 'success',
            'message' => 'Review updated',
            'data' => $review
        ]);
    }

    public function destroy($id)
    {
        $review = Review::find($id);

        if (!$review) {
            return response()->json([
                'status' => 'error',
                'message' => 'Review not found'
            ], 404);
        }

        $review->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Review deleted'
        ]);
    }
}
