import logging
from onlinepayments.sdk.merchant.i_merchant_client import IMerchantClient
from app.application.dtos.payment_link.request_dto import CreatePaymentLinkRequestDto
from app.application.dtos.payment_link.response_dto import CreatePaymentLinkResponseDto
from app.application.interfaces.sdk_clients.payment_link_client_interface import PaymentLinkClientInterface
from app.infrastructure.mappers.exception_mapper import ExceptionMapper
from app.infrastructure.mappers.payment_link_mapper import PaymentLinkMapper

logger = logging.getLogger(__name__)


class PaymentLinkClient(PaymentLinkClientInterface):

    def __init__(self, merchant_client: IMerchantClient):
        self._merchant_client = merchant_client

    def create_payment_link(self, request_dto: CreatePaymentLinkRequestDto) -> CreatePaymentLinkResponseDto:
        try:
            request = PaymentLinkMapper.to_sdk_request(request_dto)
            logger.info(
                f"Creating payment link request for payment - Amount: {request.order.amount_of_money.amount}; Currency: {request.order.amount_of_money.currency_code}.")
            response = self._merchant_client.payment_links().create_payment_link(request)
            logger.info(f"Successful payment link - Redirect url: {response.redirection_url}.")

            return PaymentLinkMapper.from_sdk_response(response)
        except Exception as ex:
            logger.error(f"Error occurred while creating payment link: {str(ex)}")
            raise ExceptionMapper.map(ex)
