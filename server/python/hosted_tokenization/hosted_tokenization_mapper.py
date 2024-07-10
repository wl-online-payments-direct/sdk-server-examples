from utils import to_amount
from onlinepayments.sdk.domain.create_payment_request import CreatePaymentRequest # type: ignore

def to_hosted_tokenization_request(hosted_tokenization_dto):

    payment_request_dict = {
        "order": {
            "amountOfMoney": {
                "amount": to_amount(hosted_tokenization_dto['amount']),
                "currencyCode": hosted_tokenization_dto['currency']
            },
            "customer": {
                "device": {
                    "acceptHeader": "texthtml,application/xhtml+xml,application/xml;q=0.9,/;q=0.8",
                    "browserData": {
                        "colorDepth": 24,
                        "javaEnabled": False,
                        "screenHeight": "1200",
                        "screenWidth": "1920"
                    },
                    "ipAddress": "123.123.123.123",
                    "locale": "en_GB",
                    "userAgent": "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_4) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/12.1 Safari/605.1.15",
                    "timezoneOffsetUtcMinutes": "420"
                }
            }
        },
        "hostedTokenizationId": hosted_tokenization_dto['hostedTokenizationId'],
        "cardPaymentMethodSpecificInput": {
            "authorizationMode": "SALE"
        }
    }

    create_payment_request = CreatePaymentRequest()
    create_payment_request.from_dictionary(payment_request_dict)

    return create_payment_request