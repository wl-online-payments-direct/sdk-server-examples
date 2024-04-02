const config = require('../configuration/config')
const utils = require('../utils/utils')

/**
 * Creates a hosted checkout dto
 */
exports.toEmptyDto = () => {
    const emptyDto = {
        redirectUrl: config.hostedCheckout.redirectUrl
    };

    return emptyDto;
}

/**
 * Converts hosted checkout dto to hosted checkout request
 */
exports.toCreateHostedCheckoutRequest = (hostedCheckoutDto) => {
    const hostedCheckoutRequest = {
        order: {
            amountOfMoney: {
                amount: utils.toAmount(hostedCheckoutDto.amount),
                currencyCode: hostedCheckoutDto.currency
            }
        },
        hostedCheckoutSpecificInput: {
            returnUrl: hostedCheckoutDto.redirectUrl
        }
    }
    return hostedCheckoutRequest;
}


