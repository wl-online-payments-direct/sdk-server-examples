var express = require('express');
var router = express.Router();
var hostedCheckoutController = require('../hostedcheckout/hostedCheckoutController')

router.get('/', function (req, res) {
    const emptyDto = hostedCheckoutController.initializeRequest();
    res.json(emptyDto)
})

router.get('/outcome', async (req, res) => {
    const paymentResponse = await hostedCheckoutController.getPaymentResponse(req);
    res.json(paymentResponse)
})

router.post('/basic', async (req, res) => {
    const hostedCheckoutResponse = await hostedCheckoutController.createHostedCheckout(req);
    res.json(hostedCheckoutResponse)
})

module.exports = router;