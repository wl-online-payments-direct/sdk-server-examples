document.addEventListener('DOMContentLoaded', () => {

    const hostedTokenizationAmount = document.getElementById('hosted-tokenization-amount');

    // Initialize Inputmask with a decimal number mask format
    Inputmask('9{+}.9{2}').mask(hostedTokenizationAmount); // Allows numbers like "123.45"

});
