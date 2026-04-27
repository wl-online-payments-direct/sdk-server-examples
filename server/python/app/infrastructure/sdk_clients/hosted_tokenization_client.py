import logging
from onlinepayments.sdk.domain.create_hosted_tokenization_request import CreateHostedTokenizationRequest
from onlinepayments.sdk.merchant.i_merchant_client import IMerchantClient
from app.application.dtos.hosted_tokenization.response_dto import HostedTokenizationResponseDto
from app.application.interfaces.sdk_clients.hosted_tokenization_client_interface import \
    HostedTokenizationClientInterface
from app.infrastructure.mappers.exception_mapper import ExceptionMapper
from app.infrastructure.mappers.hosted_tokenization_mapper import HostedTokenizationMapper

logger = logging.getLogger(__name__)


class HostedTokenizationClient(HostedTokenizationClientInterface):

    def __init__(self, merchant_client: IMerchantClient):
        self._merchant_client = merchant_client

    def init_hosted_tokenization(self) -> HostedTokenizationResponseDto:
        try:
            logger.info("The generation of the hosted tokenization ID has started.")
            request = CreateHostedTokenizationRequest()
            response = self._merchant_client.hosted_tokenization().create_hosted_tokenization(request)
            logger.info(
                f"Generation of the hosted tokenization ID successfully completed - HostedTokenizationId: {response.hosted_tokenization_id}.")

            return HostedTokenizationMapper.from_sdk_response(response)
        except Exception as ex:
            logger.error(f"Error occurred while creating hosted tokenization: {str(ex)}")
            raise ExceptionMapper.map(ex)
