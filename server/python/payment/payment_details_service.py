from configuration.merchant_client_config import merchant_client

def get_payment_details(payment_id):
    return merchant_client().payments().get_payment_details(payment_id)

def get_payment_details_for_hosted_checkout(hosted_checkout_id):
    payment_id = f'{hosted_checkout_id}_0'
    return merchant_client().payments().get_payment_details(payment_id)