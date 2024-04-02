const config = require('../configuration/config')
const utils = require('../utils/utils')

/**
 * Creates a payment request dto used for basic payment request
 */
exports.toEmptyBasicDto = () => {
    const emptyBasicDto = {
        cardNumber: "4012000033330026",
        cardHolder: "Willie E. Coyote",
        expiryMonth: "05",
        expiryYear: "29",
        cvv: "123"
    };

    return emptyBasicDto;
}

/**
 * Converts the payment request dto into payment request
 */
exports.toPaymentRequest = (paymentRequestDto) => {
    const paymentRequest = {
        cardPaymentMethodSpecificInput: {
            card: {
                cardNumber: paymentRequestDto.cardNumber,
                cardholderName: paymentRequestDto.cardHolder,
                expiryDate: `${paymentRequestDto.expiryMonth}${paymentRequestDto.expiryYear}`,
                cvv: paymentRequestDto.cvv
            },
            paymentProductId: 1
        },
        order: {
            amountOfMoney: {
                amount: utils.toAmount(paymentRequestDto.amount),
                currencyCode: paymentRequestDto.currency
            },
            customer: {
                device: {
                    acceptHeader: "texthtml,application/xhtml+xml,application/xml;q=0.9,/;q=0.8",
                    browserData: {
                        colorDepth: 24,
                        javaEnabled: false,
                        screenHeight: "1200",
                        screenWidth: "1920"
                    },
                    ipAddress: "123.123.123.123",
                    locale: "en_GB",
                    userAgent: "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_4) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/12.1 Safari/605.1.15",
                    timezoneOffsetUtcMinutes: "420"
                }
            }
        }
    }

    return paymentRequest;
}
