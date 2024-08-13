document.addEventListener("DOMContentLoaded", function () {
    var stripe = Stripe("pk_test_51PgCN0G5usHw8cVaT7DVhYW8bbPJ3VdHNJR9ducWQ3OqaA4TTyqCR9BdNshB27sQnGSd5wlDLwD1uuBevL8AHU8f00xYmmo9oN");
    var elements = stripe.elements();

    var style = {
        base: {
            color: "#32325d",
            fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
            fontSmoothing: "antialiased",
            fontSize: "16px",
            "::placeholder": {
                color: "#aab7c4",
            },
        },
        invalid: {
            color: "#fa755a",
            iconColor: "#fa755a",
        },
    };

    var card = elements.create("cardNumber", { style: style });
    card.mount("#card-element");

    var cardExpiry = elements.create("cardExpiry", { style: style });
    cardExpiry.mount("#card-expiry-element");

    var cardCvc = elements.create("cardCvc", { style: style });
    cardCvc.mount("#card-cvc-element");

    card.addEventListener("change", function (event) {
        var displayError = document.getElementById("card-errors");
        if (event.error) {
            displayError.textContent = event.error.message;
        } else {
            displayError.textContent = "";
        }
    });

    var form = document.getElementById("payment-form");
    form.addEventListener("submit", function (event) {
        event.preventDefault();

        var cardholderName = document.getElementById("cardholder-name").value;

        stripe.createToken(card, { name: cardholderName }).then(function (result) {
            if (result.error) {
                var errorElement = document.getElementById("card-errors");
                errorElement.textContent = result.error.message;
            } else {
                stripeTokenHandler(result.token);
            }
        });
    });

    function stripeTokenHandler(token) {
        var form = document.getElementById("payment-form");
        var hiddenInput = document.createElement("input");
        hiddenInput.setAttribute("type", "hidden");
        hiddenInput.setAttribute("name", "stripeToken");
        hiddenInput.setAttribute("value", token.id);
        form.appendChild(hiddenInput);

        fetch("../Back-End/Process_Payment.php", {
            method: "POST",
            body: new FormData(form),
        })
        .then(function (response) {
            return response.json();
        })
        .then(function (data) {
            if (data.status === "success") {
                clearCart(); // Clear the cart after successful payment
                showPopup("Payment Successful!", "Your payment has been processed successfully.", function() {
                    window.location.href = "../Views/Cart.php";
                });
            } else {
                showPopup("Payment Failed", "Error: " + data.error);
            }
        })
        .catch(function (error) {
            showPopup("Payment Failed", "Error: " + error.message);
        });
    }

    function clearCart() {
        fetch('../Back-End/Clear_Cart.php', { method: 'POST' })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                console.log("Cart cleared successfully.");
                cartItems = []; 
                renderCartItems(); 
            } else {
                console.error("Error clearing cart:", data.message);
            }
        })
        .catch(error => console.error("Error clearing cart:", error));
    }

    function showPopup(title, message, callback) {
        var popup = document.createElement("div");
        popup.classList.add("popup");
        popup.innerHTML = `
            <div class="popup-content">
                <h2>${title}</h2>
                <p>${message}</p>
                <button id="close-popup">OK</button>
            </div>
        `;
        document.body.appendChild(popup);

        document.getElementById("close-popup").addEventListener("click", function () {
            popup.remove();
            if (typeof callback === "function") {
                callback();
            }
        });
    }
});
