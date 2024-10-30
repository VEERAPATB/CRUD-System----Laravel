<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"> <!-- Character set for the document -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Responsive design for mobile devices -->
    
    <!-- Link to your CSS file for styling the form -->
    <link rel="stylesheet" href="{{ asset('assets/css/create-box.css') }}">

    <title>Create Product</title> <!-- Title of the webpage -->
</head>
<body>
    <div class="container"> <!-- Main container for the form -->
        <h1>CREATE PRODUCT</h1> <!-- Heading for the form -->

        <!-- Form for creating a new product -->
        <form method="post" action="{{ route('product.store') }}">
            @csrf <!-- CSRF protection token for form submission -->
            @method('post') <!-- Specify the request method as POST -->

            <div class="form-group"> <!-- Container for the Product Name input -->
                <label for="product-name">Product Name:</label> <!-- Label for the Product Name field -->
                <input type="text" id="name" name="name" required> <!-- Input field for Product Name -->
            </div>

            <div class="form-group"> <!-- Container for the Description input -->
                <label for="product-description">Description:</label> <!-- Label for the Description field -->
                <textarea id="description" name="description" placeholder="maximum 255 charecter" rows="4" required></textarea> <!-- Textarea for Product Description -->
            </div>

            <div class="form-group"> <!-- Container for the Price input -->
                <label for="product-price">Price:</label> <!-- Label for the Price field -->
                <input type="number" id="price" name="price" placeholder="0.00" step="0.01" required> <!-- Input field for Price -->
            </div>

            <div class="form-group"> <!-- Container for the Quantity input -->
                <label for="product-quantity">Quantity:</label> <!-- Label for the Quantity field -->
                <input type="number" id="qty" name="qty" placeholder="0" required> <!-- Input field for Quantity -->
            </div>

            <div class="create-button ">
                <x-button text="Back" type="button" url="{{route('product.index')}}" variant="back" />
                <!-- Edit Button -->
                <x-button text="Create Product" type="submit" variant="submit" />
            </div>
        
        </form>
    </div>
</body>
</html>
