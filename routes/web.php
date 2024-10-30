<?php

use Illuminate\Support\Facades\Route; // Import the Route facade for defining routes
use App\Http\Controllers\ProductController; // Import the ProductController

/*
|---------------------------------------------------------------------------
| Web Routes
|---------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route for the home page
Route::get('/', function () {
    return view('welcome'); // Return the welcome view for the root URL
});

// Route to display the list of products
Route::get('/product', [ProductController::class, 'index'])->name('product.index');

// Route to show the form for creating a new product
Route::get('/product/create', [ProductController::class, 'create'])->name('product.create');

// Route to store a new product in the database
Route::post('/product', [ProductController::class, 'store'])->name('product.store');

// Route to show the form for editing an existing product
Route::get('/product/{product}/edit', [ProductController::class, 'edit'])->name('product.edit');

// Route to update an existing product in the database
Route::put('/product/{product}/update', [ProductController::class, 'update'])->name('product.update');

// Route to delete a product from the database
Route::delete('/product/{product}/delete', [ProductController::class, 'delete'])->name('product.delete'); // Fixed typo in 'delete' from 'detele'
Route::delete('products/multi-delete', [ProductController::class, 'multiDelete'])->name('product.multi-delete');
