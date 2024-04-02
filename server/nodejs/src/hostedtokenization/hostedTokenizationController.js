const config = require('../configuration/config')
const paymentDetailsService = require('../payment/paymentDetailsService')
const createPaymentService = require('../payment/createPaymentService')
const hostedTokenizationService = require('./hostedTokenizationService')
const mapper = require('./hostedTokenizationMapper')

/**
 * Initializes the hosted tokenization request
 */
exports.initializeRequest = async () => {
    const hostedTokenizationResponse = await hostedTokenizationService.initHostedTokenization();
    return hostedTokenizationResponse;
}

/**
 * Gets a payment response for a provided payment id as a query param
 */
exports.getPaymentResponse = async (req) => {
    if (req.query.paymentId === undefined || req.query.paymentId === '')
        throw new Exception("Payment id is missing");

    const paymentId = req.query.paymentId;    

    const paymentDetailsResponse = await paymentDetailsService.getPaymentDetails(paymentId);
    return paymentDetailsResponse.body;
}

/**
 * Creates a payment for hosted tokenization
 */
exports.createHostedTokenizationPayment = async (req) => {
    const paymentRequest = mapper.toHostedTokenizationRequest(req.body);
    const paymentResponse = await createPaymentService.createPayment(paymentRequest)
    return paymentResponse.body
}