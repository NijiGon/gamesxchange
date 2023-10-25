<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Platform;
use App\Models\TransactionMethod;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $platforms = Platform::all();
        $methods = TransactionMethod::all();
        $carts = auth()->user()->carts;
        return view('cart', compact('carts', 'platforms', 'methods'));
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
            'user_id' => 'required|exists:users,id',
            'game_id' => 'required|exists:games,id',
            'quantity' => 'required|integer|min:1',
        ]);
    
        // Check if a cart entry already exists for the user and game
        $existingCart = Cart::where('user_id', $validatedData['user_id'])
            ->where('game_id', $validatedData['game_id'])
            ->first();
    
        if ($existingCart) {
            // If an entry already exists, update the quantity
            $existingCart->update(['quantity' => $existingCart->quantity + $validatedData['quantity']]);
        } else {
            // If no entry exists, create a new cart entry
            $cart = Cart::create([
                'user_id' => $validatedData['user_id'],
                'game_id' => $validatedData['game_id'],
                'quantity' => $validatedData['quantity'],
            ]);

            $cart->save();
        }
        
    
        return redirect()->route('cart')
            ->with('success', 'Game added to your cart successfully.');
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
    public function destroy()
    {
        $carts = auth()->user()->carts;

        foreach ($carts as $cart){
            
            if (!$cart) {
                return redirect()->route('cart')->with('error', 'Cart item not found.');
            }
        
            // Delete the cart item
            $cart->delete();
        }

        return redirect()->route('cart')->with('success', 'Cart item deleted successfully.');
    }
}
