<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Link to your CSS files for styling -->
    <link rel="stylesheet" href="{{ asset('assets/css/index.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/alert-success.css') }}">
    
    <title>Product List</title> <!-- Title of the webpage -->
</head>
<body>

    <h1>PRODUCT LIST</h1> <!-- Main heading for the product list -->

    <!-- Check for a success message in the session -->
    @if(session()->has('success'))
        <div class="popup-overlay" id="popup"> <!-- Overlay for the success popup -->
            <div class="popup-content"> <!-- Content of the popup -->
                <h2>Success!</h2> <!-- Popup heading -->
                {{ session('success') }} <!-- Display the success message -->
                <button class="close-btn" onclick="closePopup()">Close</button> <!-- Button to close the popup -->
            </div>
        </div> <!-- End of popup div -->
    @endif
    <div class= "container">
        <div class="create-product-button">
            <a href=" {{route('product.create')}} "><button>Create Product</button></a>
        </div>
    </div>
    
    <div class="table-container"> <!-- Container for the product table -->
        <table border="1"> <!-- Start of the table with a border -->
            <thead>
                <tr> <!-- Table header row -->
                    <th>ID</th> <!-- Column for Product ID -->
                    <th>Name</th> <!-- Column for Product Name -->
                    <th>Quantity</th> <!-- Column for Product Quantity -->
                    <th>Price</th> <!-- Column for Product Price -->
                    <th>Description</th> <!-- Column for Product Description -->
                        <th></th> 
                        <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product) <!-- Loop through each product in the products array -->
                <tr>
                    <td>{{ $product->id }}</td> <!-- Display Product ID -->
                    <td>{{ $product->name }}</td> <!-- Display Product Name -->
                    <td>{{ $product->qty }}</td> <!-- Display Product Quantity -->
                    <td>{{ $product->price }}</td> <!-- Display Product Price -->
                    <td>{{ $product->description }}</td> <!-- Display Product Description -->
                    <td>
                        <a href="{{ route('product.edit', ['product' => $product]) }}">Edit</a> <!-- Link to edit the product -->
                    </td>
                    <td>
                        <!-- Form for deleting a product -->
                        <form method="post" action="{{ route('product.delete', ['product' => $product]) }}">
                            @csrf <!-- CSRF protection token -->
                            @method('delete') <!-- Specify the request method as DELETE -->
                            <input type="submit" value="Delete"/> <!-- Submit button to delete the product -->
                        </form>
                    </td>   
                </tr>
                @endforeach <!-- End of products loop -->
            </tbody>
        </table>
    </div> <!-- End of table container -->

    <!-- Pagination links -->
    <div class="pagination">
        {{ $products->links() }} <!-- Display pagination links -->
    </div>

    <!-- Link to your JavaScript file for additional functionality -->
    <script src="{{ asset('assets/js/alert.js') }}"></script>

</body>
</html>
