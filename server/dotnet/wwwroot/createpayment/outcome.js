document.addEventListener('DOMContentLoaded', () => {
    const outcomeForm = document.getElementById('outcome-form');
    const outcomeResponse = document.getElementById('outcome-response');
    const linkHeader = document.getElementById('header');

    const page = new URLSearchParams(window.location.search).get("page");

    if (page !== undefined)
        linkHeader.href += page;
    else
        linkHeader.href += 'basic.html';

    const fetchPaymentDetails = () => {
        const outcomeUrl = "/api/createpayment/outcome" + window.location.search;

        fetch(outcomeUrl, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
            }
        })
            .then(response => response.json())
            .then(paymentDetails => {
                outcomeResponse.textContent = JSON.stringify(paymentDetails, null, 2);
            });
    };

    fetchPaymentDetails();
});
