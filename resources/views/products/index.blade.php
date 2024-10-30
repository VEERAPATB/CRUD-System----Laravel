<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"> <!-- Character encoding for the document -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Responsive design settings -->
    <link rel="stylesheet" href="{{ asset('assets/css/index.css') }}"> <!-- Main stylesheet -->
    <link rel="stylesheet" href="{{ asset('assets/css/alert-success.css') }}"> <!-- Stylesheet for alert messages -->
    <title>Product List</title> <!-- Title of the page -->
</head>
<body>
    <h1 class="page-title">PRODUCT LIST</h1> <!-- Main title of the page -->

    <div class="container"> <!-- Main container for the content -->
        <div class="button-and-search"> <!-- Container for search and buttons -->
            <form action="{{ route('product.index') }}" method="GET" class="search-form inline-form"> <!-- Search form -->
                <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Name product"> <!-- Search input field -->
                <x-button text="Search" type="submit" variant="edit" /> <!-- Search button -->
            </form>
            <div class="button-group"> <!-- Group for action buttons -->
                <x-button text="Create Product" url="{{ route('product.create') }}" variant="create" /> <!-- Create product button -->
                <!-- Delete Selected Button -->
                <button id="delete-selected-btn" class="multi-delete-btn" onclick="confirmMultiDelete()" disabled>Delete Selected</button>
            </div>
        </div>
        
        <div class="table-container"> <!-- Container for the product table -->
            <table class="product-table"> <!-- Table for displaying products -->
                <thead>
                    <tr>
                        <th>
                            <input type="checkbox" id="select-all-checkbox" onclick="toggleSelectAll(this)"> ID <!-- Checkbox to select all products -->
                            <a href="{{ route('product.index', ['sort' => 'id', 'order' => request('order') == 'asc' ? 'desc' : 'asc', 'search' => request('search')]) }}"> <!-- Sort by ID link -->
                                @if(request('sort') == 'id') <!-- Show sorting indicator if sorted by ID -->
                                    <span>{{ request('order') == 'asc' ? '▲' : '▼' }}</span>
                                @endif
                            </a>
                        </th>
                        <th>Name</th> <!-- Product name header -->
                        <th>Quantity</th> <!-- Product quantity header -->
                        <th>Price</th> <!-- Product price header -->
                        <th>Description</th> <!-- Product description header -->
                        <th style="width: 200px;">Actions</th> <!-- Actions header with fixed width -->
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $product) <!-- Loop through products -->
                        <tr>
                            <td>
                                <input type="checkbox" name="selected_products[]" value="{{ $product->id }}" class="product-checkbox" onclick="toggleDeleteButton()"> <!-- Checkbox for selecting individual products -->
                                {{ $product->id }} <!-- Display product ID -->
                            </td>
                            <td>{{ $product->name }}</td> <!-- Display product name -->
                            <td>{{ $product->qty }}</td> <!-- Display product quantity -->
                            <td>{{ $product->price }}</td> <!-- Display product price -->
                            <td>{{ $product->description }}</td> <!-- Display product description -->
                            <td>
                                <div class="action-buttons"> <!-- New container for action buttons -->
                                    <form method="POST" action="#" class="inline-form"> <!-- Form for adding product (action URL to be defined) -->
                                        @csrf <!-- CSRF token for security -->
                                        <x-button text="Add" type="submit" variant="add" /> <!-- Add button -->
                                    </form>
                                    <x-button text="Edit" url="{{ route('product.edit', $product->id) }}" variant="edit" /> <!-- Edit button -->
                                    <form method="post" action="{{ route('product.delete', $product) }}" class="inline-form" data-product-id="{{ $product->id }}"> <!-- Form for deleting product -->
                                        @csrf <!-- CSRF token for security -->
                                        @method('delete') <!-- Method spoofing for DELETE request -->
                                        <button type="button" class="action-button delete-button" onclick="confirmDelete('{{ $product->id }}', '{{ $product->name }}')">Delete</button> <!-- Delete button -->
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty <!-- Display if no products are found -->
                        <tr>
                            <td colspan="6">No Record Found</td> <!-- Message for no records -->
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="pagination"> <!-- Pagination controls -->
            {{ $products->appends(['search' => request('search'), 'sort' => request('sort'), 'order' => request('order')])->links() }} <!-- Pagination links with query parameters -->
        </div>

        <!-- Delete Confirmation Popups -->
        <div class="popup-overlay" id="delete-popup" style="display: none;"> <!-- Popup for single delete confirmation -->
            <div class="popup-content">
                <h2>Confirm Deletion</h2>
                <p>Are you sure you want to delete <strong id="delete-product-name"></strong>? </p> <!-- Confirmation message -->
                <button class="confirm-delete-btn" id="confirm-delete-btn">Yes, Delete</button> <!-- Confirm delete button -->
                <button class="close-btn" onclick="closeDeletePopup()">Cancel</button> <!-- Cancel button -->
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

        @if(session()->has('success')) <!-- Check for success message in session -->
            <div class="popup-overlay" id="popup"> <!-- Popup for success message -->
                <div class="popup-content">
                    <h2>Success!</h2> <!-- Success heading -->
                    {{ session('success') }} <!-- Display success message -->
                    <button class="close-btn" onclick="closePopup()">Close</button> <!-- Close button -->
                </div>
            </div>
        @endif

        <script src="{{ asset('assets/js/alert.js') }}"></script> <!-- Script for alert functionalities -->
        <script src="{{ asset('assets/js/muti-delete.js') }}"></script> <!-- Script for multi-delete functionalities -->
    </div>
</body>
</html>
