<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div class="container">
        <h1>Create Product</h1>
        <form action="{{route('product.store'}}" method="post"> 
            @csrf
            <!-- Change action URL as needed -->
            <div class="form-group">
                <label for="product-name">Product Name:</label>
                <input type="text" id="product-name" name="name" required>
            </div>

            <div class="form-group">
                <label for="product-description">Description:</label>
                <textarea id="product-description" name="description" rows="4" required></textarea>
            </div>

            <div class="form-group">
                <label for="product-price">Price:</label>
                <input type="number" id="product-price" name="price" step="0.01" required>
            </div>

            <div class="form-group">
                <label for="product-quantity">Quantity:</label>
                <input type="number" id="product-quantity" name="quantity" required>
            </div>

            <button type="submit">Create Product</button>
        </form>
    </div>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            width: 50%;
            margin: 50px auto;
            padding: 20px;
            background: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input, textarea, select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            background-color: #28a745;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }
        button:hover {
            background-color: #218838;
        }
    </style>
</body>
</html>