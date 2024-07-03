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

                    if (typeof item.price === 'number') {
                        cardPrice.textContent = `$${item.price.toFixed(2)}`;
                    } else {
                        cardPrice.textContent = 'Price not available';
                    }

                    cardContent.appendChild(cardTitle);
                    cardContent.appendChild(cardDescription);
                    cardContent.appendChild(cardPrice);

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
