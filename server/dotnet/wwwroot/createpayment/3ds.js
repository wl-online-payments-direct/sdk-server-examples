document.addEventListener('DOMContentLoaded', () => {
    const createPayment3DSForm = document.getElementById('create-payment-3ds-form');
    const inputCardNumber = document.getElementById('card-number');
    const inputCardHolder = document.getElementById('card-holder');
    const selectExpiryMonth = document.getElementById('expiry-month');
    const selectExpiryYear = document.getElementById('expiry-year');
    const inputCvv = document.getElementById('cvv');
    const createPaymentAmount = document.getElementById('create-payment-amount');
    const createPaymentCurrency = document.getElementById('create-payment-currency');
    const inputReturnUrl = document.getElementById('return-url');


    // Initialize Inputmask with a decimal number mask format
    Inputmask('9{+}.9{2}').mask(createPaymentAmount); // Allows numbers like "123.45"

    // Function to fetch and display create payments
    const fetchCreatePayment = () => {
        fetch('/api/createpayment/3ds')
            .then(response => response.json())
            .then(createPayment => {
                if (inputCardNumber.value === '')
                    inputCardNumber.value = createPayment.cardNumber;
                if (inputCardHolder.value === '')
                    inputCardHolder.value = createPayment.cardHolder;
                if (selectExpiryMonth.value === '')
                    selectExpiryMonth.value = createPayment.expiryMonth;
                if (selectExpiryYear.value === '')
                    selectExpiryYear.value = createPayment.expiryYear;
                if (inputCvv.value === '')
                    inputCvv.value = createPayment.cvv;
                if (createPaymentAmount.value === '')
                    createPaymentAmount.value = createPayment.amount;
                if (createPaymentCurrency.value === '')
                    createPaymentCurrency.value = createPayment.currency;
                if (inputReturnUrl.value === '')
                    inputReturnUrl.value = createPayment.returnUrl;
            });
    };

    // Function to create a new payment
    const createPayment3DS = (cardNumber, cardHolder, expiryMonth, expiryYear, cvv, amount, currency, returnUrl) => {
        fetch('/api/createpayment/3ds', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({cardNumber, cardHolder, expiryMonth, expiryYear, cvv, amount, currency, returnUrl}),
        })
            .then((response) => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json(); // Parse the JSON response
            })
            .then((data) => {
                window.location.href = '/createpayment/outcome.html?paymentId=' + data.payment.id + '&page=3ds.html';
            });
    };

    // Submit event listener for adding a task
    createPayment3DSForm.addEventListener('submit', (e) => {
        e.preventDefault();
        const cardNumber = inputCardNumber.value.trim();
        const cardHolder = inputCardHolder.value.trim();
        const expiryMonth = selectExpiryMonth.value.trim();
        const expiryYear = selectExpiryYear.value.trim();
        const cvv = inputCvv.value.trim();
        const amount = createPaymentAmount.value.trim();
        const currency = createPaymentCurrency.value;
        const returnUrl = inputReturnUrl.value.trim();
        if (cardNumber !== '' && expiryMonth != '' && expiryYear != '' && cvv != '' && amount !== '' && currency !== '' && returnUrl !== '') {
            createPayment3DS(cardNumber, cardHolder, expiryMonth, expiryYear, cvv, amount, currency, returnUrl);
        }
    });

    // Fetch and display hosted checkouts on page load
    fetchCreatePayment();
});
