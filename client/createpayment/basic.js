document.addEventListener('DOMContentLoaded', () => {
    const createPaymentBasicForm = document.getElementById('create-payment-basic-form');
    const inputCardNumber = document.getElementById('card-number');
    const inputCardHolder = document.getElementById('card-holder');
    const selectExpiryMonth = document.getElementById('expiry-month');
    const selectExpiryYear = document.getElementById('expiry-year');
    const inputCvv = document.getElementById('cvv');
    const createPaymentAmount = document.getElementById('create-payment-amount');
    const createPaymentCurrency = document.getElementById('create-payment-currency');

    // Initialize Inputmask with a decimal number mask format
    Inputmask('9{+}.9{2}').mask(createPaymentAmount); // Allows numbers like "123.45"

    // Function to fetch and display create payments
    const fetchCreatePayment = () => {
        fetch('/api/createpayment')
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
            });
    };

    // Function to create a new payment
    const createPaymentBasic = (cardNumber, cardHolder, expiryMonth, expiryYear, cvv, amount, currency) => {
        fetch('/api/createpayment/basic', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({cardNumber, cardHolder, expiryMonth, expiryYear, cvv, amount, currency}),
        })
            .then((response) => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json(); // Parse the JSON response
            })
            .then((data) => {
                window.location.href = '/createpayment/outcome.html?paymentId=' + data.payment.id + '&page=basic.html';
            });
    };

    // Submit event listener for adding a task
    createPaymentBasicForm.addEventListener('submit', (e) => {
        e.preventDefault();
        const cardNumber = inputCardNumber.value.trim();
        const cardHolder = inputCardHolder.value.trim();
        const expiryMonth = selectExpiryMonth.value.trim();
        const expiryYear = selectExpiryYear.value.trim();
        const cvv = inputCvv.value.trim();
        const amount = createPaymentAmount.value.trim();
        const currency = createPaymentCurrency.value;
        if (cardNumber !== '' && expiryMonth != '' && expiryYear != '' && cvv != '' && amount !== '' && currency !== '') {
            createPaymentBasic(cardNumber, cardHolder, expiryMonth, expiryYear, cvv, amount, currency);
        }
    });

    // Fetch and display hosted checkouts on page load
    fetchCreatePayment();
});
