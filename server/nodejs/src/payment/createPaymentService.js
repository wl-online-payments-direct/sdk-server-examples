const config = require('../configuration/config')
const paymentSdk = require('../configuration/paymentSdk')

/**
 * Invokes a create payment request from the paymentSdk API
 */
exports.createPayment = async (paymentRequest) => {
    const paymentResponse = await paymentSdk.payments.createPayment(config.merchantId, paymentRequest, {});
    return paymentResponse;
}