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

    <div class="container">
        <div class="button-and-search">
            <form action="{{ route('product.index') }}" method="GET">
                <div class="input-group mb-3">
                    <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Name product">
                    <button type="submit" class="btn btn-primary">Search</button>
                </div>
            </form>
            <x-button text="Create Product" url="{{ route('product.create') }}" variant="create" />

            <!-- Delete Selected Button -->
            <button id="delete-selected-btn" class="multi-delete-btn" onclick="confirmMultiDelete()" disabled>Delete All</button>
        </div>
    </div>
        
    <div class="table-container">
        <table border="1">
            <thead>
                <tr>
                    <!-- Checkbox Header for Select All -->
                    <th><input type="checkbox" id="select-all-checkbox" onclick="toggleSelectAll(this)">ID</th>
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
                        <!-- Checkbox for each product row -->
                        <td><input type="checkbox" name="selected_products[]" value="{{ $product->id }}" class="product-checkbox" onclick="toggleDeleteButton()">{{ $product->id}}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->qty }}</td>
                        <td>{{ $product->price }}</td>
                        <td>{{ $product->description }}</td>
                        <td>
                            <!-- Edit Button -->
                            <x-button text="Edit" url="{{ route('product.edit', $product->id) }}" variant="edit" />
                            
                            <!-- Delete Button -->
                            <form method="post" action="{{ route('product.delete', $product) }}" style="display:inline" data-product-id="{{ $product->id }}">
                                @csrf
                                @method('delete')
                                <button type="button" class="action-button delete-button" onclick="confirmDelete('{{ $product->id }}', '{{ $product->name }}')">Delete</button> 
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

    <!-- Delete Confirmation Popup for Single Item -->
    <div class="popup-overlay" id="delete-popup" style="display: none;">
        <div class="popup-content">
            <h2>Confirm Deletion</h2>
            <p>Are you sure you want to delete <strong id="delete-product-name"></strong>?</p>
            <button class="confirm-delete-btn" id="confirm-delete-btn">Yes, Delete</button>
            <button class="close-btn" onclick="closeDeletePopup()">Cancel</button>
        </div>
    </div>

    <!-- Multi-Delete Confirmation Popup -->
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

    <!-- JavaScript for Select All, Multi-Delete, and Alert -->
    <script src="{{ asset('assets/js/alert.js') }}"></script>
    <script src="{{ asset('assets/js/muti-delete.js') }}"></script>
    
</body>
</html>
