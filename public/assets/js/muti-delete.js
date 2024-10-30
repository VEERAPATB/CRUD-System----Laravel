// delete.js
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

function toggleSelectAll(selectAllCheckbox) {
    const checkboxes = document.querySelectorAll('.product-checkbox');
    checkboxes.forEach(checkbox => {
        checkbox.checked = selectAllCheckbox.checked;
    });
    toggleDeleteButton();
}

// Enable/Disable the Delete Selected Button based on checkbox selection
function toggleDeleteButton() {
    const checkboxes = document.querySelectorAll('.product-checkbox:checked');
    document.getElementById('delete-selected-btn').disabled = checkboxes.length === 0;
}


// Show Multi-Delete Confirmation Popup
function confirmMultiDelete() {
    const selected = Array.from(document.querySelectorAll('.product-checkbox:checked')).map(cb => cb.value);
    if (selected.length > 0) {
        document.getElementById('multi-delete-popup').style.display = 'flex';
    }
}

// Close Multi-Delete Popup
function closeMultiDeletePopup() {
    document.getElementById('multi-delete-popup').style.display = 'none';
}

// Delete Selected Products
function deleteSelectedProducts() {
    const selectedIds = Array.from(document.querySelectorAll('.product-checkbox:checked')).map(cb => cb.value);
    const form = document.createElement('form');
    form.method = 'POST';
    form.action = "{{ route('product.multi-delete') }}"; // Define this route in web.php for multi-delete
    
    // Add CSRF token and method as hidden inputs
    form.innerHTML = '@csrf<input type="hidden" name="_method" value="DELETE">';
    selectedIds.forEach(id => {
        const input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'product_ids[]';
        input.value = id;
        form.appendChild(input);
    });

    document.body.appendChild(form);
    form.submit();
}