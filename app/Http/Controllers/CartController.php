<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = Auth::user()->cartItems()->with('product')->get();

        return view('cart.index', compact('cartItems'));
    }

    public function store(Request $request, Product $product)
    {
        $cartItem = Auth::user()->cartItems()->firstOrCreate(
            ['product_id' => $product->id],
            ['quantity' => 0]
        );
        $cartItem->quantity += $request->quantity;
        $cartItem->save();

        return redirect()->route('cartPage');
    }

    public function destroy(CartItem $cartItem)
    {
        $cartItem->delete();
        return redirect()->route('cartPage');
    }
}
