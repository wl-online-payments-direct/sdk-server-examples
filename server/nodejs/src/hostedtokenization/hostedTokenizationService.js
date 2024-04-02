const config = require('../configuration/config')
const paymentSdk = require('../configuration/paymentSdk')

/**
 * Invokes a getPaymentDetails request towards the paymentSdk API for given payment id
 */
exports.initHostedTokenization = async () => {
    const hostedTokenizationResponse = await paymentSdk.hostedTokenization.createHostedTokenization(config.merchantId, {}, {});
    return hostedTokenizationResponse.body;
}