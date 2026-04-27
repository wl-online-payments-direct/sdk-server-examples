import logging
from onlinepayments.sdk.merchant.merchant_client import MerchantClient
from app.application.dtos.hosted_checkout.request_dto import CreateHostedCheckoutRequestDto
from app.application.dtos.hosted_checkout.response_dto import CreateHostedCheckoutResponseDto
from app.application.dtos.get_payment_by_hosted_checkout_id.response_dto import GetPaymentByHostedCheckoutIdResponseDto
from app.application.interfaces.sdk_clients.hosted_checkout_client_interface import HostedCheckoutClientInterface
from app.infrastructure.mappers.hosted_checkout_mapper import HostedCheckoutMapper
from app.infrastructure.mappers.exception_mapper import ExceptionMapper

logger = logging.getLogger(__name__)


class HostedCheckoutClient(HostedCheckoutClientInterface):

    def __init__(self, merchant_client: MerchantClient):
        self._merchant_client = merchant_client

    def create_hosted_checkout(self, request_dto: CreateHostedCheckoutRequestDto) -> CreateHostedCheckoutResponseDto:
        try:
            request = HostedCheckoutMapper.to_sdk_request(request_dto)
            logger.info(
                f"Creating hosted checkout request for payment - Amount: {request.order.amount_of_money.amount}; Currency: {request.order.amount_of_money.currency_code}.")
            response = self._merchant_client.hosted_checkout().create_hosted_checkout(request)
            logger.info(f"Successful hosted checkout - Redirect url: {response.redirect_url}.")

            return HostedCheckoutMapper.from_sdk_create_response(response)
        except Exception as ex:
            logger.error(f"Error occurred while creating hosted checkout: {str(ex)}")
            raise ExceptionMapper.map(ex)

    def get_payment_by_hosted_checkout_id(self, id: str) -> GetPaymentByHostedCheckoutIdResponseDto:
        try:
            logger.info(f"Get payment by hosted checkout id: {id} started.")
            response = self._merchant_client.hosted_checkout().get_hosted_checkout(id)
            logger.info("Payment details retrieved successfully.")

            return HostedCheckoutMapper.from_sdk_get_response(response)
        except Exception as ex:
            logger.error(f"Error occurred while getting create_payment: {str(ex)}")
            raise ExceptionMapper.map(ex)
