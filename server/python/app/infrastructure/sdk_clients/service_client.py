import logging
from onlinepayments.sdk.merchant.i_merchant_client import IMerchantClient
from app.application.dtos.service.get_payment_product_id.request_dto import GetPaymentProductIdRequestDto
from app.application.dtos.service.get_payment_product_id.response_dto import GetPaymentProductIdResponseDto
from app.application.interfaces.sdk_clients.service_client_interface import ServiceClientInterface
from app.infrastructure.mappers.exception_mapper import ExceptionMapper
from app.infrastructure.mappers.service_mapper import ServiceMapper
from app.application.exceptions.sdk_exception import SdkException

logger = logging.getLogger(__name__)


class ServiceClient(ServiceClientInterface):

    def __init__(self, merchant_client: IMerchantClient):
        self._merchant_client = merchant_client

    def get_payment_product_id(self, request_dto: GetPaymentProductIdRequestDto) -> GetPaymentProductIdResponseDto:
        masked_card = request_dto.card_number[:4] + "*" * (len(request_dto.card_number) - 8) + request_dto.card_number[
            -4:]

        try:
            logger.info(f"Fetching the payment product id for card number: {masked_card}.")

            sdk_request = ServiceMapper.to_sdk_request(request_dto)
            sdk_response = self._merchant_client.services().get_iin_details(sdk_request)

            if sdk_response.payment_product_id is None:
                logger.info(f"No valid payment product id found for card number: {masked_card}.")
                raise SdkException(f"No valid payment product id found for card number: {masked_card}.")

            logger.info(
                f"Payment product id: {sdk_response.payment_product_id} returned for card number: {masked_card}.")

            return ServiceMapper.from_sdk_response(sdk_response)
        except Exception as ex:
            logger.error(f"Error occurred while fetching payment product id: {masked_card}.")
            raise ExceptionMapper.map(ex)
