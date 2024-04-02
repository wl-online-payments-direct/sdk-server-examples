var express = require('express');
var router = express.Router();
var createPaymentController = require('../payment/createPaymentController')

router.get('/', (req, res) => {
    const emptyBasicDto = createPaymentController.initializeRequest();
    res.json(emptyBasicDto)
})

router.get('/outcome', async (req, res) => {
    const paymentResponse = await createPaymentController.getPaymentResponse(req);
    res.json(paymentResponse)
})

router.post('/basic', async (req, res) => {
    const paymentResponse = await createPaymentController.createPaymentRequest(req);
    res.json(paymentResponse)
})

module.exports = router;