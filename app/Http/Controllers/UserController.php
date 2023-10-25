<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $user = auth()->user();
        $reviews = auth()->user()->reviews;
        return view('profile', compact('user', 'reviews'));
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
    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['nullable', 'string', 'max:255'],
            'email' => ['nullable', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ]);

        try {
            // Find the user by their identifier (e.g., $id)
            $user = User::findOrFail(auth()->user()->id);
    
            // Update the user's information
            if (!empty($validatedData['name'])) {
                $user->name = $validatedData['name'];
            }
            if (!empty($validatedData['email'])) {
                $user->email = $validatedData['email'];
            }
            $role = str_contains($validatedData['email'], '@admin') ? 'admin' : 'customer';
            $user->role = $role;
            if (!empty($validatedData['password'])) {
                $user->password = Hash::make($validatedData['password']);
            }
            // Update other fields as needed
    
            $user->save();
    
            return redirect()->route('home')->with('success', 'User information updated successfully');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to update user information');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
