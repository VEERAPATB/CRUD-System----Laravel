<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('products.index', ['products' => $products]);
        
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request){
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

    public function edit(Product $product){
        return view('products.edit', ['product' => $product]);
    }   
    
    public function update(Product $product, Request $request){
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'qty' => 'required|integer|min:1',
            'price' => 'required|numeric|between:0,99999.99',
            'description' => 'nullable|string|max:1000'
        ]);
        $product->update($data);

        return redirect(route('product.index'))->with('success','Your data has been updated successfully.');
    }
}
