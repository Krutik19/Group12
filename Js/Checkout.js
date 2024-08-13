document.addEventListener('DOMContentLoaded', function() {
    const checkoutForm = document.getElementsByClassName('checkout-form');

    checkoutForm.addEventListener('submit', function(event) {
        let valid = true;

        document.querySelectorAll('.error-message').forEach(span => span.textContent = '');

        // First name validation
        const firstName = document.getElementById('billing-FirstName');
        if (firstName.value.trim() === '') {
            valid = false;
            document.getElementById('firstNameError').textContent = 'First name is required.';
        }

        // Last name validation
        const lastName = document.getElementById('billing-LastName');
        if (lastName.value.trim() === '') {
            valid = false;
            document.getElementById('lastNameError').textContent = 'Last name is required.';
        }

        // Email validation
        const email = document.getElementById('billing-Email');
        const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        if (!emailPattern.test(email.value.trim())) {
            valid = false;
            document.getElementById('emailError').textContent = 'Invalid email address.';
        }

        // Billing address validation
        const ShippingAddress = document.getElementById('billing-address');
        if (ShippingAddress.value.trim() === '') {
            valid = false;
            document.getElementById('ShippingAddressError').textContent = 'Shipping address is required.';
        }

        // City validation
        const city = document.getElementById('billing-city');
        if (city.value.trim() === '') {
            valid = false;
            document.getElementById('cityError').textContent = 'City is required.';
        }

        // Zip code validation
        const zip = document.getElementById('billing-zip');
        const zipPattern = /^[A-Z]\d[A-Z] \d[A-Z]\d$/;
        if (!zipPattern.test(zip.value.trim())) {
            valid = false;
            document.getElementById('zipError').textContent = 'Invalid zip code.';
        }

        if (!valid) {
            event.preventDefault();
        }
    });
});
