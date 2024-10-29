<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"> <!-- Character set for the document -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Responsive design for mobile devices -->
    
    <!-- Link to your CSS file for styling the form -->
    <link rel="stylesheet" href="{{ asset('assets/css/create-box.css') }}">

    <title>Edit Product</title> <!-- Title of the webpage -->
</head>
<body>
    <div class="container"> <!-- Main container for the form -->
        <h1>EDIT PRODUCT</h1> <!-- Heading for the form -->

        <!-- Form for editing an existing product -->
        <form method="post" action="{{ route('product.update', ['product' => $product]) }}">
            @csrf <!-- CSRF protection token for form submission -->
            @method('put') <!-- Specify the request method as PUT for updating -->

            <div class="form-group"> <!-- Container for the Product Name input -->
                <label for="product-name">Name product:</label> <!-- Label for the Product Name field -->
                <input type="text" id="name" name="name" value="{{ $product->name }}" required> <!-- Input field for Product Name, pre-filled with existing value -->
            </div>

            <div class="form-group"> <!-- Container for the Description input -->
                <label for="product-description">Description:</label> <!-- Label for the Description field -->
                <textarea id="description" name="description" placeholder="maximum 255 charecter" rows="4" required>{{ $product->description }}</textarea> <!-- Textarea for Product Description, pre-filled with existing value -->
            </div>

            <div class="form-group"> <!-- Container for the Price input -->
                <label for="product-price">Price:</label> <!-- Label for the Price field -->
                <input type="number" id="price" name="price" placeholder="0.00" step="0.01" value="{{ $product->price }}" required> <!-- Input field for Price, pre-filled with existing value -->
            </div>

            <div class="form-group"> <!-- Container for the Quantity input -->
                <label for="product-quantity">Quantity:</label> <!-- Label for the Quantity field -->
                <input type="number" id="qty" name="qty" placeholder="0" value="{{ $product->qty }}" required> <!-- Input field for Quantity, pre-filled with existing value -->
            </div>

            <button type="submit">Update Product</button> <!-- Submit button to update the product -->
        </form>
    </div>
</body>
</html>
