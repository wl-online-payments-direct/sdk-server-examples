const config = require('../configuration/config')
const paymentSdk = require('../configuration/paymentSdk')

/**
 * Invokes a getPaymentDetails request towards the paymentSdk API for given payment id
 */
exports.getPaymentDetails = async (paymentId) => {
    const paymentDetails = await paymentSdk.payments.getPaymentDetails(config.merchantId, paymentId, {});
    return paymentDetails;
}

/**
 * Invokes a getPaymentDetails request towards the paymentSdk API for given hosted checkout id
 */
exports.getPaymentDetailsForHostedCheckout = async (hostedCheckoutId) => {
    const paymentId = `${hostedCheckoutId}_0`;
    return await this.getPaymentDetails(paymentId);
}