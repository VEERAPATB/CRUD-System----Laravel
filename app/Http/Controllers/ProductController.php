<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    // Display a listing of the products
    public function index(Request $request)
    {
        // Initialize $search with an empty string if there's no search term
        $search = $request->input('search', '');

        // Start a query for products
        $query = Product::query();

        // Apply search conditions if a search term exists
        if (!empty($search)) {
            $query->where('id', 'LIKE', "%{$search}%")
                ->orWhere('name', 'LIKE', "%{$search}%")
                ->orWhere('description', 'LIKE', "%{$search}%")
                ->orWhere('qty', 'LIKE', "%{$search}%")
                ->orWhere('price', 'LIKE', "%{$search}%");
        }

        // Paginate the products (showing 10 products per page)
        $products = $query->simplePaginate(10);

        // Return the index view with the list of products and the search term
        return view('products.index', compact('products', 'search'));
    }

    // Show the form for creating a new product
    public function create()
    {
        return view('products.create'); // Return the create product view
    }

    // Store a newly created product in the database
    public function store(Request $request)
    {
        // Validate inputs from the request
        $data = $request->validate([
            'name' => 'required|string|max:255', // Name is required, must be a string, max 255 characters
            'qty' => 'required|integer|min:1', // Quantity is required, must be an integer, minimum 1
            'price' => 'required|numeric|between:0,99999.99', // Price is required, must be a numeric value within the specified range
            'description' => 'nullable|string|max:1000' // Description is optional, must be a string, max 1000 characters
        ]);

        // Log the data being inserted for debugging purposes
        \Log::info('Product Data:', $data);

        // Create a new product record in the database
        $newProduct = Product::create($data);

        // Redirect to the product index page
        return redirect(route('product.index'));
    }

    // Show the form for editing the specified product
    public function edit(Product $product)
    {
        return view('products.edit', ['product' => $product]); // Return the edit view with the product data
    }

    // Update the specified product in the database
    public function update(Product $product, Request $request)
    {
        // Validate inputs for updating
        $data = $request->validate([
            'name' => 'required|string|max:255', // Name is required, must be a string, max 255 characters
            'qty' => 'required|integer|min:1', // Quantity is required, must be an integer, minimum 1
            'price' => 'required|numeric|between:0,99999.99', // Price is required, must be a numeric value within the specified range
            'description' => 'nullable|string|max:1000' // Description is optional, must be a string, max 1000 characters
        ]);

        // Update the product with the validated data
        $product->update($data);

        // Redirect to the product index page with a success message
        return redirect(route('product.index'))->with('success', 'Your data has been updated successfully.');
    }

    // Delete the specified product from the database
    public function delete(Product $product)
    {
        $product->delete(); // Delete the product record

        // Redirect to the product index page with a success message
        return redirect(route('product.index'))->with('success', 'Your data has been deleted successfully.');
    }

    public function multiDelete(Request $request)
    {
        Product::whereIn('id', $request->product_ids)->delete();
        return redirect()->route('product.index')->with('success', 'Selected products have been deleted successfully.');
    }

}
