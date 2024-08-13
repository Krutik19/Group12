document.getElementById('add-chef-button').addEventListener('click', function() {
    document.getElementById('add-chef-form').style.display = 'block';
    document.getElementById('update-chef-form').style.display = 'none';
});

function editChef(chefId) {
    const chefCard = event.target.closest('.chef-card');
    const name = chefCard.querySelector('h3').innerText;
    const bio = chefCard.querySelector('p').innerText;
    const specialty = chefCard.querySelector('p').innerText;
    const imageUrl = chefCard.querySelector('img').src;

    document.getElementById('update-chef-id').value = chefId;
    document.getElementById('update-name').value = name;
    document.getElementById('update-bio').value = bio;
    document.getElementById('update-specialty').value = specialty;
    document.getElementById('update-image_url').value = imageUrl;

    document.getElementById('add-chef-form').style.display = 'none';
    document.getElementById('update-chef-form').style.display = 'block';
}

function deleteChef(chefId) {
    if (confirm("Are you sure you want to delete this chef?")) {
        fetch(`../../Admin/View/Manage_Chef.php?action=delete&chef_id=${chefId}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            }
        })
        .then(response => response.text())
        .then(data => {
            alert(data); 
            location.reload(); 
        })
        .catch(error => console.error('Error:', error));
    }
}