// Function to fetch chefs data using plain JavaScript AJAX
function fetchChefs() {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', '../Back-End/Show_Chef.php', true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                var response = JSON.parse(xhr.responseText);
                if (response.success) {
                    displayChefs(response.chefs);
                } else {
                    console.error('Error fetching chefs: ' + response.message);
                }
            } else {
                console.error('Error fetching chefs. Status Code: ' + xhr.status);
            }
        }
    };
    xhr.send();
}

// Function to display chefs on the webpage in grid layout
function displayChefs(chefs) {
    var chefContainer = document.getElementById('chef-container');
    chefContainer.classList.add('grid-view'); // Add grid view class

    chefs.forEach(function(chef) {
        var chefCard = `
            <div class="staff-area">
                <div class="staff">
                    <div class="staff-img" style="background-image: url('${chef.image_url}');"></div>
                    <div class="text">
                        <h3>${chef.name}</h3>
                        <p>${chef.specialty}</p>
                        <div>
                            <p class="staff-para">${chef.bio}</p>
                        </div>
                    </div>
                </div>
            </div>
        `;
        chefContainer.insertAdjacentHTML('beforeend', chefCard);
    });
}

// Call fetchChefs function to initiate fetching chefs
fetchChefs();
