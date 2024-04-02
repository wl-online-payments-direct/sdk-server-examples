const mapper = require('./createPaymentMapper')
const paymentDetailsService = require('./paymentDetailsService')
const createPaymentService = require('./createPaymentService')

/**
 * Initializes a request with an empty basic create payment dto
 */
exports.initializeRequest = () => {
    return mapper.toEmptyBasicDto();
}

/**
 * Initializes a request with an empty 3ds create payment dto
 */
exports.initializeRequestWith3DS = () => {
    return mapper.toEmpty3DSDto();
}

/**
 * Gets a payment response for a provided payment id as a query param
 */
exports.getPaymentResponse = async function (req) {
    if (req.query.paymentId === undefined || req.query.paymentId === '')
        throw new Exception("Payment id is missing");

    const paymentId = req.query.paymentId;    

    const paymentDetailsResponse = await paymentDetailsService.getPaymentDetails(paymentId);
    return paymentDetailsResponse.body
}

/**
 * Performs a basic payment request
 */
exports.createPaymentRequest = async function (req) {
    const paymentRequest = mapper.toPaymentRequest(req.body);
    const paymentResponse = await createPaymentService.createPayment(paymentRequest)
    return paymentResponse.body
}

/**
 * Performs a 3ds payment request
 */
exports.createPaymentRequestWith3DS = async function (req) {
    const paymentRequest = mapper.toPaymentRequestWith3DS(req.body);
    const paymentResponse = await createPaymentService.createPayment(paymentRequest)
    return paymentResponse.body
}