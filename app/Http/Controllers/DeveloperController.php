<?php

namespace App\Http\Controllers;

use App\Models\Developer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DeveloperController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $developer = Developer::all();
        return view('developer.list', compact('developer'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('developers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:4096', // Adjust the image rules as needed
        ]);
    
        // Handle image upload and storage
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            // $imageName = $image->getClientOriginalName();
            $imageName = time().'.'.$image->getClientOriginalExtension();
            // $image->storeAs('images', $imageName, 'public');
            Storage::disk('public')->putFileAs('Asset/developers', $image, $imageName);
        }
    
        // Create a new Developer instance and store it in the database
        $developer = Developer::create([
            'name' => $validatedData['name'],
            'description' => $validatedData['description'],
            'image' => $imageName,
        ]);

        $developer->save();
    
        return redirect()->route('developer.show', ['id' => $developer->id])
            ->with('success', 'Developer added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $developer = Developer::find($id);

        $games = $developer->games;

        if(!$developer) return abort(404);

        return view('developers.show', compact('developer', 'games'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function modify(string $id)
    {
        $developer = Developer::find($id);

        return view('developers.update', compact('developer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'required|image|max:2048', // Adjust the image rules as needed
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            // $imageName = $image->getClientOriginalName();
            $imageName = time().'.'.$image->getClientOriginalExtension();
            // $image->storeAs('images', $imageName, 'public');
            Storage::disk('public')->putFileAs('Asset/developers', $image, $imageName);
        }

        try {
            // Find the user by their identifier (e.g., $id)
            $game = Developer::findOrFail($id);
    
            // $imageName = basename($imagePath);
    
            $game->name = $validatedData['name'];
            $game->description = $validatedData['description'];
            $game->image = $imageName;
            // Update other fields as needed
    
            $game->save();
    
            return redirect()->route('home')->with('success', 'Developer information updated successfully');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to update developer information');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find the resource by its ID
        $developer = Developer::find($id);

        // Check if the resource exists
        if ($developer) {
            // Delete the resource
            $games = $developer->games;

            foreach($games as $g){
                $details = $g->transactions;

                $carts = $g->carts;

                $reviews = $g->reviews;

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

                $g->delete();
            }

            $developer->delete();

            // Redirect back or to another page
            return redirect()->route('home')->with('success', 'Resource deleted successfully');
        } else {
            // If the resource does not exist, redirect with an error message
            return redirect()->route('home')->with('error', 'Resource not found');
        }
    }
}
