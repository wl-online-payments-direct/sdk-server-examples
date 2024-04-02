const utils = require('../utils/utils')

/**
 * Converts the hosted tokenization dto into hosted tokenization request
 */
exports.toHostedTokenizationRequest = (hostedTokenizationDto) => {
    const paymentRequest = {
        order: {
            amountOfMoney: {
                amount: utils.toAmount(hostedTokenizationDto.amount),
                currencyCode: hostedTokenizationDto.currency
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
        },
        hostedTokenizationId: hostedTokenizationDto.hostedTokenizationId,
        cardPaymentMethodSpecificInput: {
            authorizationMode: "SALE"
        }
    }

    return paymentRequest;
}
