
    // Function to show the popup
    function showPopup() {
        document.getElementById("popup").style.display = "flex";
    }

    // Function to close the popup
    function closePopup() {
        document.getElementById("popup").style.display = "none";
    }

    // Show the popup automatically after data is updated
    // Call showPopup() in the appropriate location in your application
    showPopup(); // For testing purposes; remove if using conditional logic

// alert.js
function confirmDelete(productId, productName) {
    document.getElementById('delete-product-name').innerText = productName;
    document.getElementById('delete-popup').style.display = 'flex';

    // Set the confirm button to delete the specific product
    const confirmButton = document.getElementById('confirm-delete-btn');
    confirmButton.onclick = function() {
        deleteProduct(productId);
    };
}

function closeDeletePopup() {
    document.getElementById('delete-popup').style.display = 'none';
}

function deleteProduct(productId) {
    // Find and submit the form for the product with the given ID
    const form = document.querySelector(`form[data-product-id="${productId}"]`);
    if (form) {
        form.submit();
    }
    closeDeletePopup();
}
