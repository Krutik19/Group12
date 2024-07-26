document.getElementById('categoryDropdown').addEventListener('change', function() {
    const categoryId = this.value;
    if (categoryId) {
        fetch(`../Back-End/Show_Menu.php?category_id=${categoryId}`)
            .then(response => response.json())
            .then(data => {
                const productsContainer = document.getElementById('productsContainer');
                productsContainer.innerHTML = '';

                data.forEach(item => {
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
                    cardPrice.textContent = `$${item.price.toFixed(2)}`;

                    // Add to Cart button
                    const addToCartButton = document.createElement('button');
                    addToCartButton.className = 'add-to-cart-button';
                    addToCartButton.textContent = 'Add to Cart';
                    addToCartButton.addEventListener('click', function() {
                        addToCart(item.item_id, 1);
                    });

                    cardContent.appendChild(cardTitle);
                    cardContent.appendChild(cardDescription);
                    cardContent.appendChild(cardPrice);
                    cardContent.appendChild(addToCartButton); // Append button to card

                    card.appendChild(img);
                    card.appendChild(cardContent);

                    productsContainer.appendChild(card);
                });
            })
            .catch(error => console.error('Error fetching menu items:', error));
    } else {
        const productsContainer = document.getElementById('productsContainer');
        productsContainer.innerHTML = '';
    }
});

// Function to add an item to the cart
function addToCart(itemId, quantity) {
    fetch('../Back-End/Add_To_Cart.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ item_id: itemId, quantity: quantity }),
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Item added to cart!');
        } else {
            alert('Error adding item to cart: ' + data.message);
        }
    })
    .catch(error => console.error('Error adding item to cart:', error));
}
