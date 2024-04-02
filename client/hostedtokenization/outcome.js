document.addEventListener('DOMContentLoaded', () => {
    const outcomeForm = document.getElementById('outcome-form');
    const outcomeResponse = document.getElementById('outcome-response');

    const fetchPaymentDetails = () => {
        const outcomeUrl = "/api/hostedtokenization/outcome" + window.location.search;

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
