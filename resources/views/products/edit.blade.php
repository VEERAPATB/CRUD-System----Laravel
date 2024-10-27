<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Corrected link to your CSS file -->
    <link rel="stylesheet" href="{{ asset('assets/css/create-box.css') }}">

    <title>Document</title>
</head>
<body>
    <div class="container">
        <h1>Create Product</h1>
        <form method="post" action="{{route('product.update', ['product' =>$product])}}">
        @csrf 
        @method('put')
        <div class="form-group">
                <label for="product-name">Edit Infomation Product:</label>
                <input type="text" id="name" name="name" value="{{$product->name}}" required>
                
            </div>

            <div class="form-group">
                <label for="product-description">Description:</label>
                <textarea id="description" name="description" rows="4" required>{{ $product->description }}</textarea>
            </div>

            <div class="form-group">
                <label for="product-price">Price:</label>
                <input type="number" id="price" name="price" placeholder="0.00" step="0.01" value= "{{$product->price}}" required>
            </div>

            <div class="form-group">
                <label for="product-quantity">Quantity:</label>
                <input type="number" id="qty" name="qty" placeholder="0" value= "{{$product->qty}}" required>
            </div>


            <button type="submit">Create Product</button>
    </form>
    </div>

</body>
</html>