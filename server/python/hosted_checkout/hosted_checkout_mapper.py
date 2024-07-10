from utils import to_amount
from configuration.config_reader import read_config
from onlinepayments.sdk.domain.create_hosted_checkout_request import CreateHostedCheckoutRequest # type: ignore

def to_empty_dto():
    empty_dto = {
        "redirectUrl": read_config()['hostedCheckout']['redirectUrl']
    }

    return empty_dto

def to_hosted_checkout_request(hosted_checkout_request_dto):

    hosted_checkout_request_dict = {
        "order": {
            "amountOfMoney": {
                "amount": to_amount(hosted_checkout_request_dto['amount']),
                "currencyCode": hosted_checkout_request_dto['currency']
            }
        },
        "hostedCheckoutSpecificInput": {
            "returnUrl": hosted_checkout_request_dto['redirectUrl']
        }
    }

    hosted_checkout_request = CreateHostedCheckoutRequest()
    hosted_checkout_request.from_dictionary(hosted_checkout_request_dict)

    return hosted_checkout_request