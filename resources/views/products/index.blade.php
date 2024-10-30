<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('assets/css/index.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/alert-success.css') }}">
    <title>Product List</title>
    <style>
        /* Add custom CSS styles for button alignment */
        .action-buttons {
            display: flex; /* Use flexbox for alignment */
            gap: 10px; /* Space between buttons */
        }
    </style>
</head>
<body>
    <h1 class="page-title">PRODUCT LIST</h1>

    <div class="container">
        <div class="button-and-search">
            <form action="{{ route('product.index') }}" method="GET" class="search-form inline-form">
                <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Name product">
                <x-button text="Search" type="submit" variant="edit" />
            </form>
            <div class="button-group">
                <x-button text="Create Product" url="{{ route('product.create') }}" variant="create" />
                <button id="delete-selected-btn" class="multi-delete-btn" onclick="confirmMultiDelete()" disabled>Delete Selected</button>
            </div>
        </div>
        
        <div class="table-container">
            <table class="product-table">
                <thead>
                    <tr>
                        <th>
                            <input type="checkbox" id="select-all-checkbox" onclick="toggleSelectAll(this)"> ID
                            <a href="{{ route('product.index', ['sort' => 'id', 'order' => request('order') == 'asc' ? 'desc' : 'asc', 'search' => request('search')]) }}">
                                @if(request('sort') == 'id')
                                    <span>{{ request('order') == 'asc' ? '▲' : '▼' }}</span>
                                @endif
                            </a>
                        </th>
                        <th>Name</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Description</th>
                        <th style="width: 200px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $product)
                        <tr>
                            <td>
                                <input type="checkbox" name="selected_products[]" value="{{ $product->id }}" class="product-checkbox" onclick="toggleDeleteButton()">
                                {{ $product->id }}
                            </td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->qty }}</td>
                            <td>{{ $product->price }}</td>
                            <td>{{ $product->description }}</td>
                            <td>
                                <div class="action-buttons"> <!-- New container for buttons -->
                                    <form method="POST" action="{{ route('cart.add', $product->id) }}" class="inline-form">
                                        @csrf
                                        <x-button text="Add" type="submit" variant="add" />
                                    </form>
                                    <x-button text="Edit" url="{{ route('product.edit', $product->id) }}" variant="edit" />
                                    <form method="post" action="{{ route('product.delete', $product) }}" class="inline-form" data-product-id="{{ $product->id }}">
                                        @csrf
                                        @method('delete')
                                        <button type="button" class="action-button delete-button" onclick="confirmDelete('{{ $product->id }}', '{{ $product->name }}')">Delete</button>
                                    </form>
                                    
                                </div>
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
            {{ $products->appends(['search' => request('search'), 'sort' => request('sort'), 'order' => request('order')])->links() }}
        </div>

        <!-- Delete Confirmation Popups -->
        <div class="popup-overlay" id="delete-popup" style="display: none;">
            <div class="popup-content">
                <h2>Confirm Deletion</h2>
                <p>Are you sure you want to delete <strong id="delete-product-name"></strong>?</p>
                <button class="confirm-delete-btn" id="confirm-delete-btn">Yes, Delete</button>
                <button class="close-btn" onclick="closeDeletePopup()">Cancel</button>
            </div>
        </div>

        <div class="popup-overlay" id="multi-delete-popup" style="display: none;">
            <div class="popup-content">
                <h2>Confirm Multi-Deletion</h2>
                <p>Are you sure you want to delete the selected products?</p>
                <button class="confirm-delete-btn" onclick="deleteSelectedProducts()">Yes, Delete</button>
                <button class="close-btn" onclick="closeMultiDeletePopup()">Cancel</button>
            </div>
        </div>

        @if(session()->has('success'))
            <div class="popup-overlay" id="popup">
                <div class="popup-content">
                    <h2>Success!</h2>
                    {{ session('success') }}
                    <button class="close-btn" onclick="closePopup()">Close</button>
                </div>
            </div>
        @endif

        <script src="{{ asset('assets/js/alert.js') }}"></script>
        <script src="{{ asset('assets/js/muti-delete.js') }}"></script>
    </div>
</body>
</html>
