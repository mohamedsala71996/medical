<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $authUserId = Auth::id(); // Get the ID of the currently authenticated user
        $userIdToRate = $request->user_id;

        // Ensure users cannot rate themselves
        if ($authUserId == $userIdToRate) {
            return redirect()->back()->with('error', 'You cannot rate yourself.');
        }

        // Check if the user has already rated this user
        $existingRating = Rating::where('user_id', $userIdToRate)
                                ->where('rated_by', $authUserId)
                                ->first();

        if ($existingRating) {
            return redirect()->back()->with('error', 'You have already rated this user.');
        }

        // Store the rating
        Rating::create([
            'user_id' => $userIdToRate,
            'rating' => $request->rating,
            'rated_by' => $authUserId,
        ]);

        return redirect()->back()->with('success', 'Rating submitted successfully.');
    }
}
