<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // Import HasFactory trait for factory methods
use Illuminate\Database\Eloquent\Model; // Import the base Model class

class Product extends Model
{
    use HasFactory; // Use the HasFactory trait to enable factory methods for this model

    // Specify which attributes are mass assignable
    protected $fillable = [
        'name',         // The name of the product
        'qty',          // The quantity of the product
        'price',        // The price of the product
        'description'   // A description of the product
    ];
}
