from utils import to_amount
from onlinepayments.sdk.domain.create_payment_request import CreatePaymentRequest # type: ignore

def to_empty_dto():
    empty_dto = {
        "cardNumber": "4012000033330026",
        "cardHolder": "Willie E. Coyote",
        "expiryMonth": "05",
        "expiryYear": "29",
        "cvv": "123"
    }

    return empty_dto

def to_payment_request(payment_request_dto):
    payment_request_dict = {
        'cardPaymentMethodSpecificInput': {
            'card': {
                'cardNumber': payment_request_dto['cardNumber'],
                'cardholderName': payment_request_dto['cardHolder'],
                'expiryDate': payment_request_dto['expiryMonth'] + payment_request_dto['expiryYear'],
                'cvv': payment_request_dto['cvv']
            },
            'paymentProductId': 1
        },
        'order': {
            'amountOfMoney': {
                'amount': to_amount(payment_request_dto['amount']),
                'currencyCode': payment_request_dto['currency']
            },
            'customer': {
                'device': {
                    'acceptHeader': 'texthtml,application/xhtml+xml,application/xml;q=0.9,/;q=0.8',
                    'browserData': {
                        'colorDepth': 24,
                        'javaEnabled': False,
                        'screenHeight': '1200',
                        'screenWidth': '1920'
                    },
                    'ipAddress': '123.123.123.123',
                    'locale': 'en_GB',
                    'userAgent': 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_4) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/12.1 Safari/605.1.15',
                    'timezoneOffsetUtcMinutes': '420'
                }
            }
        }
    }

    payment_request = CreatePaymentRequest()
    payment_request.from_dictionary(payment_request_dict)

    return payment_request