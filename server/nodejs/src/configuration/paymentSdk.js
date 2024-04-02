const config = require('./config') 
const onlinePaymentsSdk = require('onlinepayments-sdk-nodejs');

const paymentSdk = onlinePaymentsSdk.init({
    integrator: config.integrator,
    host: config.host,
    scheme: 'https',
    port: 443,
    enableLogging: true,
    apiKeyId: config.apiKey,
    secretApiKey: config.apiSecret
});

module.exports = paymentSdk;