from onlinepayments.sdk.communicator_configuration import CommunicatorConfiguration
from onlinepayments.sdk.factory import Factory
from onlinepayments.sdk.merchant.i_merchant_client import IMerchantClient

from config.settings import Settings

def create_merchant_client(settings: Settings) -> IMerchantClient:

    communicator_configuration = CommunicatorConfiguration()
    communicator_configuration.api_endpoint = settings.api_endpoint
    communicator_configuration.api_key_id = settings.api_key_id
    communicator_configuration.secret_api_key = settings.api_secret_key
    communicator_configuration.integrator = settings.integrator
    communicator_configuration.authorization_type = "v1HMAC"
    communicator_configuration.connect_timeout = 100
    communicator_configuration.socket_timeout = 100
    communicator_configuration.max_connections = 10

    client = Factory.create_client_from_configuration(communicator_configuration)

    return client.merchant(settings.merchant_id)