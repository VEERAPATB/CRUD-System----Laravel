<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('assets/css/index.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/alert-success.css') }}">
    <title>Product List</title>
</head>
<body>
    <h1>PRODUCT LIST</h1>

    @if(session()->has('success'))
        <div class="popup-overlay" id="popup">
            <div class="popup-content">
                <h2>Success!</h2>
                {{ session('success') }}
                <button class="close-btn" onclick="closePopup()">Close</button>
            </div>
        </div>
    @endif

    <div class="container">
        <div class="create-product-button">
            <a href="{{ route('product.create') }}"><button>Create Product</button></a>
        </div>
    </div>

    <form action="{{ route('product.index') }}" method="GET">
        <div class="input-group mb-3">
            <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Search data">
            <button type="submit" class="btn btn-primary">Search</button>
        </div>
    </form>

    <div class="table-container">
        <table border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Description</th>
                    <th style="width: 180px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->qty }}</td>
                        <td>{{ $product->price }}</td>
                        <td>{{ $product->description }}</td>
                        <td>
                            <a href="{{ route('product.edit', $product) }}">
                                <button class="action-button edit-button">Edit</button>
                            </a>
                            <form method="post" action="{{ route('product.delete', $product) }}" style="display:inline">
                                @csrf
                                @method('delete')
                                <button type="submit" class="action-button delete-button" onclick="return confirm('Are you sure you want to delete this product?');">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">No Record Found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="pagination">
        {{ $products->appends(['search' => request('search')])->links() }}
    </div>

    <script src="{{ asset('assets/js/alert.js') }}"></script>
</body>
</html>
