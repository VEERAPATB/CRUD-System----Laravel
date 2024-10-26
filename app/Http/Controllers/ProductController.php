<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        return view('products.index');
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
{
    // Validate inputs
    $data = $request->validate([
        'name' => 'required|string|max:255',
        'qty' => 'required|integer|min:1',
        'price' => 'required|numeric|between:0,99999.99',
        'description' => 'nullable|string|max:1000'
    ]);

    // Log the data being inserted
    \Log::info('Product Data:', $data);

    // Create product
    $newProduct = Product::create($data);

    return redirect(route('product.index'));
}
    
}
