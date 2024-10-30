<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    public function add(Product $product)
    {
        // Get the cart from the session, or create a new one
        $cart = session()->get('cart', []);

        // Check if the product is already in the cart
        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity']++;
        } else {
            $cart[$product->id] = [
                'name' => $product->name,
                'quantity' => 1,
                'price' => $product->price,
            ];
        }

        // Save the updated cart to the session
        session()->put('cart', $cart);

        return redirect()->route('product.index')->with('success', 'Product added to cart successfully.');
    }

    public function viewCart()
    {
        $cart = session()->get('cart', []);
        return view('cart.view', compact('cart'));
    }

}

