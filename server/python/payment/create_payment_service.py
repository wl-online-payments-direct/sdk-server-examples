from configuration.merchant_client_config import merchant_client

def create_payment(payment_request):
    return merchant_client().payments().create_payment(payment_request)