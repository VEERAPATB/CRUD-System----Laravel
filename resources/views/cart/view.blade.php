<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
</head>
<body>
    <h1>Your Shopping Cart</h1>

    <table border="1">
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($cart as $item)
                <tr>
                    <td>{{ $item['name'] }}</td>
                    <td>{{ $item['quantity'] }}</td>
                    <td>${{ number_format($item['price'], 2) }}</td>
                    <td>${{ number_format($item['quantity'] * $item['price'], 2) }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">Your cart is empty.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <a href="{{ route('product.index') }}">Continue Shopping</a>
</body>
</html>
