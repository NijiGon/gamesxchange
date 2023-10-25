<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:255',
        ]);
    
        // Get the user's ID (assuming you're using authentication)
        $user_id = $request->user_id;
    
        // Get the game's ID (you should pass this as part of the form)
    
        $game_id = $request->game_id; // Replace 'game_id' with the actual field name from your form
        // Find the review that matches the given game_id and user_id
        $review = Review::where('game_id', $game_id)
                        ->where('user_id', $user_id)
                        ->first();

        if ($review) {
            // If a review is found, delete it
            $review->update([
                'user_id' => $user_id,
                'game_id' => $game_id,
                'rating' => $validatedData['rating'],
                'comment' => $validatedData['comment'],
            ]);
        } else {
            $review = Review::create([
                'user_id' => $user_id,
                'game_id' => $game_id,
                'rating' => $validatedData['rating'],
                'comment' => $validatedData['comment'],
            ]);
        }
        
        // Save the review to the database
        $review->save();
    
        // Redirect the user back to the game's page or a success page
        return redirect()->route('game.show', ['id' => $game_id])
            ->with('success', 'Review added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $game_id = $request->game_id;
        $user_id = $request->user_id;
        // Find the review that matches the given game_id and user_id
        $review = Review::where('game_id', $game_id)
                        ->where('user_id', $user_id)
                        ->first();

        if ($review) {
            // If a review is found, delete it
            $review->delete();
            // Redirect to a success page or return a response as needed
        }
        return redirect()->route('game.show', ['id' => $game_id])->with('success', 'Review deleted successfully.');
    }
}
