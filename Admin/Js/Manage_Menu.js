document.getElementById('add-category-button').addEventListener('click', function() {
    document.getElementById('add-category-form').style.display = 'block';
    document.getElementById('update-category-form').style.display = 'none';
});

document.getElementById('add-menu-item-button').addEventListener('click', function() {
    document.getElementById('add-menu-item-form').style.display = 'block';
    document.getElementById('update-menu-item-form').style.display = 'none';
});

function editCategory(categoryId) {
    document.getElementById('update-category-form').style.display = 'block';
    document.getElementById('add-category-form').style.display = 'none';
    // Populate the update form with category details
    var category = document.querySelector(`div[data-category-id='${categoryId}']`);
    document.getElementById('update-category-id').value = categoryId;
    document.getElementById('update-category_name').value = category.querySelector('h3').innerText;
}

function editMenuItem(itemId) {
    document.getElementById('update-menu-item-form').style.display = 'block';
    document.getElementById('add-menu-item-form').style.display = 'none';
    // Populate the update form with menu item details
    var menuItem = document.querySelector(`div[data-item-id='${itemId}']`);
    document.getElementById('update-item-id').value = itemId;
    document.getElementById('update-category_id').value = menuItem.dataset.categoryId;
    document.getElementById('update-item_name').value = menuItem.querySelector('h3').innerText;
    document.getElementById('update-description').value = menuItem.querySelector('p.description').innerText;
    document.getElementById('update-price').value = menuItem.querySelector('p.price').innerText.replace('Price: $', '');
    document.getElementById('update-image_url').value = menuItem.querySelector('img').src;
}

function deleteCategory(categoryId) {
    if (confirm('Are you sure you want to delete this category?')) {
        window.location.href = '../../Admin/View/Manage_Menu.php?category_action=delete&category_id=' + categoryId;
    }
}

function deleteMenuItem(itemId) {
    if (confirm('Are you sure you want to delete this menu item?')) {
        window.location.href = '../../Admin/View/Manage_Menu.php?menu_action=delete&item_id=' + itemId;
    }
}
