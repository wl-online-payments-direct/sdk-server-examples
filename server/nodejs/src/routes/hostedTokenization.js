var express = require('express');
var router = express.Router();
var hostedTokenizationController = require('../hostedtokenization/hostedTokenizationController')

router.get('/', async (req, res) => {
    const hostedTokenizationRequestDto = await hostedTokenizationController.initializeRequest();
    res.json(hostedTokenizationRequestDto)
})

router.get('/outcome', async (req, res) => {
    const paymentResponse = await hostedTokenizationController.getPaymentResponse(req);
    res.json(paymentResponse)
})

router.post('/basic', async (req, res) => {
    const paymentResponse = await hostedTokenizationController.createHostedTokenizationPayment(req);
    res.json(paymentResponse);
})

module.exports = router;