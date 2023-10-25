<?php

namespace App\Http\Controllers;

use App\Models\Developer;
use App\Models\Game;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $min = $request->input('min', 0);
        $max = $request->input('max', PHP_INT_MAX);
        $type = $request->input('type', 'name');
        $sort = $request->input('sort', 'asc');

        $games = Game::whereBetween('price', [$min, $max]);

        if ($type === 'ratings') {
            $games = Game::select('games.id', 'games.name', 'games.price', 'games.image')
                ->leftJoin('reviews', 'games.id', '=', 'reviews.game_id')
                ->selectRaw('games.id, games.name, AVG(reviews.rating) as average_rating')
                ->groupBy('games.id', 'games.name', 'games.price', 'games.image') // Add all necessary columns to the GROUP BY
                ->orderBy('average_rating', $sort)
                ->get();

        } else if ($type === 'name') {
            $games = $games->orderBy('name', $sort)->get();
        } else if ($type === 'price') {
            $games = $games->orderBy('price', $sort)->get();
        }

        return view('games.list', compact('games', 'min', 'max', 'type', 'sort'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $developer = Developer::all();

        return view('games.create', compact('developer'));
    }

    public function modify(string $id)
    {
        $game = Game::find($id);

        $developers = Developer::all();

        return view('games.update', compact('game', 'developers'));
    }

    public function insert()
    {
        return view('games.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'dev_id' => 'required|int',
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|integer',
            'image' => 'required|image', // Adjust the image rules as needed
        ]);
    
        // Handle image upload and storage
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            // $imageName = $image->getClientOriginalName();
            $imageName = time().'.'.$image->getClientOriginalExtension();
            // $image->storeAs('images', $imageName, 'public');
            Storage::disk('public')->putFileAs('Asset/games', $image, $imageName);
        }
    
        // Create a new Developer instance and store it in the database
        $game = Game::create([
            'dev_id' => $validatedData['dev_id'],
            'name' => $validatedData['name'],
            'price' => $validatedData['price'],
            'description' => $validatedData['description'],
            'image' => $imageName,
        ]);

        $game->save();
    
        return redirect()->route('game.show', ['id' => $game->id])
            ->with('success', 'Game added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $game = Game::find($id);

        if(!$game) return abort(404);

        $userReview = Review::where('user_id', Auth::id())
        ->where('game_id', $game->id)
        ->first();

        $review = $game->reviews;

        return view('games.show', compact('game', 'userReview', 'review'));
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
        $validatedData = $request->validate([
            'dev_id' => 'required|string',
            'name' => 'required|string|max:255',
            'price' => 'required|integer',
            'description' => 'required|string',
            'image' => 'required|image|max:2048', // Adjust the image rules as needed
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            // $imageName = $image->getClientOriginalName();
            $imageName = time().'.'.$image->getClientOriginalExtension();
            // $image->storeAs('images', $imageName, 'public');
            Storage::disk('public')->putFileAs('Asset/games', $image, $imageName);
        }

        try {
            // Find the user by their identifier (e.g., $id)
            $game = Game::findOrFail($id);
    
            // $imageName = basename($imagePath);
    
            $game->dev_id = $validatedData['dev_id'];
            $game->name = $validatedData['name'];
            $game->description = $validatedData['description'];
            $game->price = $validatedData['price'];
            $game->image = $imageName;
            // Update other fields as needed
    
            $game->save();
    
            return redirect()->route('home')->with('success', 'Game information updated successfully');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to update game information');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find the resource by its ID
        $games = Game::find($id);

        // Check if the resource exists
        if ($games) {
            // Delete the resource

            $details = $games->transactions;

            $carts = $games->carts;

            $reviews = $games->reviews;

            foreach($details as $d){
                $h =  $d->transaction;
                $d->delete();
                if($h->details->count() === 0) $h->delete();
            }

            foreach($carts as $c){
                $c->delete();
            }

            foreach($reviews as $r){
                $r->delete();
            }

            $games->delete();

            // Redirect back or to another page
            return redirect()->route('home')->with('success', 'Resource deleted successfully');
        } else {
            // If the resource does not exist, redirect with an error message
            return redirect()->route('home')->with('error', 'Resource not found');
        }
    }
}
