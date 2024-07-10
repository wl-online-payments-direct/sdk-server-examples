from configuration.merchant_client_config import merchant_client

def create_hosted_checkout(hosted_checkout_request):
    return merchant_client().hosted_checkout().create_hosted_checkout(hosted_checkout_request)