document.addEventListener('DOMContentLoaded', function() {
    const cartItemsContainer = document.getElementById('cartItemsContainer');
    const buyButton = document.getElementById('buyButton');
    let cartItems = [];

    // Fetch cart items from the server
    function fetchCartItems() {
        fetch('../Back-End/Get_Cart.php')
            .then(response => response.json())
            .then(data => {
                console.log('Cart items fetched:', data);
                cartItems = data;
                renderCartItems(); // Render cart items on the page
            })
            .catch(error => console.error('Error fetching cart items:', error));
    }

    // Render cart items on the page
    function renderCartItems() {
        cartItemsContainer.innerHTML = '';

        if (cartItems.length === 0) {
            cartItemsContainer.innerHTML = '<p>No items in cart</p>';
            updateCartSummary(); // Update cart summary if no items
            return;
        }

        // Loop through each item and create card elements
        cartItems.forEach(item => {
            const card = document.createElement('div');
            card.className = 'card';

            const img = document.createElement('img');
            img.src = item.image_url;
            img.alt = item.item_name;

            const cardContent = document.createElement('div');
            cardContent.className = 'card-content';

            const cardTitle = document.createElement('h2');
            cardTitle.className = 'card-title';
            cardTitle.textContent = item.item_name;

            const cardDescription = document.createElement('p');
            cardDescription.className = 'card-description';
            cardDescription.textContent = item.description;

            const cardPrice = document.createElement('p');
            cardPrice.className = 'card-price';
            const price = parseFloat(item.price);
            cardPrice.textContent = !isNaN(price) ? `$${price.toFixed(2)}` : 'Price unavailable';

            const quantityInput = document.createElement('input');
            quantityInput.type = 'number';
            quantityInput.className = 'quantity-input';
            quantityInput.value = item.quantity;
            quantityInput.addEventListener('change', function() {
                const newQuantity = parseInt(this.value);
                if (newQuantity >= 0) {
                    item.quantity = newQuantity;
                    updateQuantity(item.cart_item_id, newQuantity); // Update quantity in the backend
                    updateCartSummary(); // Update cart summary when quantity changes
                } else {
                    this.value = item.quantity;
                }
            });

            const removeButton = document.createElement('button');
            removeButton.textContent = 'Remove';
            removeButton.addEventListener('click', function() {
                // Remove item from cart
                fetch('../Back-End/Remove_Cart_Item.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ cart_item_id: item.cart_item_id })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        cartItems = cartItems.filter(i => i.cart_item_id !== item.cart_item_id);
                        renderCartItems(); // Re-render cart items after removal
                    } else {
                        console.error('Error removing item from cart:', data.message);
                    }
                })
                .catch(error => console.error('Error removing item:', error));
            });

            cardContent.appendChild(cardTitle);
            cardContent.appendChild(cardDescription);
            cardContent.appendChild(cardPrice);
            cardContent.appendChild(quantityInput);
            cardContent.appendChild(removeButton);

            card.appendChild(img);
            card.appendChild(cardContent);

            cartItemsContainer.appendChild(card);
        });

        updateCartSummary(); // Update cart summary after rendering items
    }

    // Update quantity in the backend
    function updateQuantity(cart_item_id, newQuantity) {
        fetch('../Back-End/Update_Cart_Item.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ cart_item_id: cart_item_id, quantity: newQuantity })
        })
        .then(response => response.json())
        .then(data => {
            if (!data.success) {
                console.error('Error updating quantity:', data.message);
            }
        })
        .catch(error => console.error('Error updating quantity:', error));
    }

    // Update cart summary (total items, subtotal, tax, etc.)
    function updateCartSummary() {
        if (cartItems.length === 0) {
            document.getElementById('totalItems').textContent = '0';
            document.getElementById('subtotal').textContent = '$0.00';
            document.getElementById('tax').textContent = '$0.00';
            document.getElementById('deliveryCharge').textContent = '$5.00';
            document.getElementById('totalAmount').textContent = '$0.00';
            return;
        }
        const totalItems = cartItems.reduce((total, item) => total + item.quantity, 0);
        const subtotal = cartItems.reduce((total, item) => total + (item.price * item.quantity), 0);
        const tax = subtotal * 0.1;
        const deliveryCharge = 5;
        const totalAmount = subtotal + tax + deliveryCharge;

        document.getElementById('totalItems').textContent = totalItems;
        document.getElementById('subtotal').textContent = `$${subtotal.toFixed(2)}`;
        document.getElementById('tax').textContent = `$${tax.toFixed(2)}`;
        document.getElementById('deliveryCharge').textContent = `$${deliveryCharge.toFixed(2)}`;
        document.getElementById('totalAmount').textContent = `$${totalAmount.toFixed(2)}`;
    }

    // Redirect to checkout page
    buyButton.addEventListener('click', function() {
        window.location.href = '../Views/CheckOut.php';
    });

    fetchCartItems(); // Initial fetch of cart items
});
