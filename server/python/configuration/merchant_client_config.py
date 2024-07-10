from onlinepayments.sdk.factory import Factory # type: ignore
from onlinepayments.sdk.communicator_configuration import CommunicatorConfiguration # type: ignore
from configuration.config_reader import read_config

def merchant_client():

    config = read_config()

    communicator_configuration = CommunicatorConfiguration()
    communicator_configuration.api_endpoint = 'https://' + config["host"]
    communicator_configuration.api_key_id = config["apiKey"]
    communicator_configuration.secret_api_key = config["apiSecret"]
    communicator_configuration.authorization_type = "v1HMAC"
    communicator_configuration.integrator=config["integrator"]
    communicator_configuration.connect_timeout=5
    communicator_configuration.socket_timeout=300
    communicator_configuration.max_connections=10
    communicator_configuration.proxy_configuration=None
    communicator_configuration.shopping_cart_extension=None

    client = Factory.create_client_from_configuration(communicator_configuration)

    merchant_client = client.merchant(config["merchantId"])

    return merchant_client