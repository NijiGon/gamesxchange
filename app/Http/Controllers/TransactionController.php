<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\TransactionDetail;
use App\Models\TransactionHeader;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $headers = TransactionHeader::all();
        return view('history', compact('headers'));
    }

    public function code(string $id)
    {
        $details = TransactionDetail::where('transaction_id', $id)->get();
        return view('code', compact('details'));
    }

    public function show(string $id)
    {
        $details = TransactionDetail::where('transaction_id', $id)->get();
        return view('detail', compact('details'));
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
    public function store(Request $request, Cart $carts)
    {
        // Validate the form data, you can add more validation rules if needed
        $validatedData = $request->validate([
            'platform_id' => 'required|exists:platforms,id',
            'method_id' => 'required|exists:transaction_methods,id',
        ]);

        // Get the user ID from the authenticated user
        $userId = auth()->user()->id;

        // Create a new transaction header
        $transactionHeader = TransactionHeader::create([
            'user_id' => $userId,
            'platform_id' => $validatedData['platform_id'],
            'method_id' => $validatedData['method_id'],
            'transaction_date' => now(), // You can adjust the format if needed
        ]);

        // Get the cart items for the current user
        $cartItems = auth()->user()->carts;

        // Loop through each cart item and create a transaction detail
        foreach ($cartItems as $cartItem) {
            TransactionDetail::create([
                'transaction_id' => $transactionHeader->id,
                'game_id' => $cartItem->game_id,
                'quantity' => $cartItem->quantity,
            ]);

            // Remove the cart item as it's now part of the transaction
            $cartItem->delete();
        }

        return redirect()->route('code', ['id' => $transactionHeader->id])
            ->with('success', 'Transaction completed successfully.');
    }

    /**
     * Display the specified resource.
     */

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
    public function destroy(string $id)
    {
        //
    }
}
