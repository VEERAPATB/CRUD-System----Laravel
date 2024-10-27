<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Corrected link to your CSS file -->
    <link rel="stylesheet" href="{{ asset('assets/css/index.css') }}">
    
    <title>Product List</title>
</head>
<body>
    <h1>Product</h1>
    <div class="table-container">
        <table border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->qty }}</td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->description }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
