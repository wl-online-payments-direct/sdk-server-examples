const config = require('../configuration/config')
const paymentSdk = require('../configuration/paymentSdk')

/**
 * Invokes a create hosted checkout request from the paymentSdk API
 */
exports.createHostedCheckoutResponse = async (hostedCheckoutRequest) => {
    const hostedCheckoutResponse = await paymentSdk.hostedCheckout.createHostedCheckout(config.merchantId, hostedCheckoutRequest, {});
    return hostedCheckoutResponse;
}