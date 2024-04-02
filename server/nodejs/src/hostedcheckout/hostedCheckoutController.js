const config = require('../configuration/config')
const mapper = require('./hostedCheckoutMapper')
const hostedCheckoutService = require('./hostedCheckoutService')
const paymentDetailsService = require('../payment/paymentDetailsService')

/**
 * Initializes hosted checkout request
 */
exports.initializeRequest = () => {
    return mapper.toEmptyDto();
}

/**
 * Gets a payment response for a provided hosted checkout id as a query param
 */
exports.getPaymentResponse = async function (req) {
    if (req.query.hostedCheckoutId === undefined || req.query.hostedCheckoutId === '')
        throw new Exception("Hosted checkout id is missing");

    const hostedCheckoutId = req.query.hostedCheckoutId;    

    const paymentDetailsResponse = await paymentDetailsService.getPaymentDetailsForHostedCheckout(hostedCheckoutId);
    return paymentDetailsResponse.body
}

/**
 * Performs a hosted checkout request
 */
exports.createHostedCheckout = async function (req) {
    const hostedCheckoutRequest = mapper.toCreateHostedCheckoutRequest(req.body);
    const hostedCheckoutResponse = await hostedCheckoutService.createHostedCheckoutResponse(hostedCheckoutRequest)
    return hostedCheckoutResponse.body
}