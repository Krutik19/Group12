document.addEventListener('DOMContentLoaded', function() {
    const cartItemsContainer = document.getElementById('cartItemsContainer');
    const buyButton = document.getElementById('buyButton');
    let cartItems = [];

    function fetchCartItems() {
        fetch('path/to/Get_Cart.php')
            .then(response => response.json())
            .then(data => {
                console.log('Cart items fetched:', data); 
                cartItems = data;
                renderCartItems();
            })
            .catch(error => console.error('Error fetching cart items:', error));
    }

    function renderCartItems() {
        cartItemsContainer.innerHTML = '';
    
        if (cartItems.length === 0) {
            cartItemsContainer.innerHTML = '<p>No items in cart</p>';
            updateCartSummary(); // Update summary to reflect empty cart
            return;
        }
    
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
    
            // Convert price to number if it's not already
            const price = parseFloat(item.price);
            if (!isNaN(price)) {
                cardPrice.textContent = `$${price.toFixed(2)}`;
            } else {
                cardPrice.textContent = 'Price unavailable';
            }
    
            const quantityInput = document.createElement('input');
            quantityInput.type = 'number';
            quantityInput.className = 'quantity-input';
            quantityInput.value = item.quantity;
            quantityInput.addEventListener('change', function() {
                const newQuantity = parseInt(this.value);
                if (newQuantity >= 0) {
                    item.quantity = newQuantity;
                    updateCartSummary();
                } else {
                    this.value = item.quantity;
                }
            });
    
            const removeButton = document.createElement('button');
            removeButton.textContent = 'Remove';
            removeButton.addEventListener('click', function() {
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
                        // Remove item from cartItems array and re-render
                        cartItems = cartItems.filter(i => i.cart_item_id !== item.cart_item_id);
                        renderCartItems(); // Update UI
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
    
        updateCartSummary();
    }

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
        const tax = subtotal * 0.1; // Assuming 10% tax rate
        const deliveryCharge = 5; // Assuming a flat delivery charge
        const totalAmount = subtotal + tax + deliveryCharge;

        document.getElementById('totalItems').textContent = totalItems;
        document.getElementById('subtotal').textContent = `$${subtotal.toFixed(2)}`;
        document.getElementById('tax').textContent = `$${tax.toFixed(2)}`;
        document.getElementById('deliveryCharge').textContent = `$${deliveryCharge.toFixed(2)}`;
        document.getElementById('totalAmount').textContent = `$${totalAmount.toFixed(2)}`;
    }

    buyButton.addEventListener('click', function() {
        console.log('Buy button clicked!');
        console.log('Items in cart:', cartItems);
    });

    fetchCartItems();
});
