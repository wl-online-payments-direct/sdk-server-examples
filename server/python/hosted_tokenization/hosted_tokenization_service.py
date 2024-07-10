from configuration.merchant_client_config import merchant_client
from onlinepayments.sdk.domain.create_hosted_tokenization_request import CreateHostedTokenizationRequest # type: ignore

def init_hosted_tokenization():
    hosted_tokenization_request = CreateHostedTokenizationRequest()
    return merchant_client().hosted_tokenization().create_hosted_tokenization(hosted_tokenization_request)