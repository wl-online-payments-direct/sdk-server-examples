document.addEventListener('DOMContentLoaded', () => {
    const hostedCheckoutBasicForm = document.getElementById('hosted-checkout-basic-form');
    const hostedCheckoutAmount = document.getElementById('hosted-checkout-amount');
    const hostedCheckoutCurrency = document.getElementById('hosted-checkout-currency');
    const hostedCheckoutRedirectUrl = document.getElementById('redirect-url');

    // Initialize Inputmask with a decimal number mask format
    Inputmask('9{+}.9{2}').mask(hostedCheckoutAmount); // Allows numbers like "123.45"

    // Function to fetch and display hosted checkouts
    const fetchHostedCheckouts = () => {
        fetch('/api/hostedcheckout')
            .then(response => response.json())
            .then(hostedCheckout => {
                if (hostedCheckoutAmount.value === '')
                    hostedCheckoutAmount.value = hostedCheckout.amount;
                if (hostedCheckoutCurrency.value === '')
                    hostedCheckoutCurrency.value = hostedCheckout.currency;
                if (hostedCheckoutRedirectUrl.value === '')
                    hostedCheckoutRedirectUrl.value = hostedCheckout.redirectUrl;
            });
    };

    // Function to create a new hosted checkout basic
    const createHostedCheckoutBasic = (amount, currency, redirectUrl) => {
        fetch('/api/hostedcheckout/basic', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({amount, currency, redirectUrl}),
        })
            .then((response) => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json(); // Parse the JSON response
            })
            .then((data) => {
                hostedCheckoutAmount.value = '';
                hostedCheckoutCurrency.value = currency;

                window.location.href = data.redirectUrl;
            });
    };

    // Submit event listener for adding a task
    hostedCheckoutBasicForm.addEventListener('submit', (e) => {
        e.preventDefault();
        const amount = hostedCheckoutAmount.value.trim();
        const currency = hostedCheckoutCurrency.value;
        const redirectUrl = hostedCheckoutRedirectUrl.value.trim();
        if (amount !== '' && currency !== '') {
            createHostedCheckoutBasic(amount, currency, redirectUrl);
        }
    });

    // Fetch and display hosted checkouts on page load
    fetchHostedCheckouts();
});
