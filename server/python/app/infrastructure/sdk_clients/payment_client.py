import logging
from onlinepayments.sdk.merchant.i_merchant_client import IMerchantClient
from app.application.dtos.create_payment.request_dto import CreatePaymentRequestDto
from app.application.dtos.create_payment.response_dto import CreatePaymentResponseDto
from app.application.interfaces.sdk_clients.payment_client_interface import PaymentClientInterface
from app.infrastructure.mappers.additional_payment_actions.cancel_payment_mapper import CancelPaymentMapper
from app.infrastructure.mappers.additional_payment_actions.capture_payment_mapper import CapturePaymentMapper
from app.infrastructure.mappers.additional_payment_actions.refund_payment_mapper import RefundPaymentMapper
from app.infrastructure.mappers.exception_mapper import ExceptionMapper
from app.infrastructure.mappers.payment_details_mapper import PaymentDetailsMapper
from app.infrastructure.mappers.payment_mapper import PaymentMapper

logger = logging.getLogger(__name__)


class PaymentClient(PaymentClientInterface):

    def __init__(self, merchant_client: IMerchantClient):
        self._merchant_client = merchant_client

    def create_payment(self, request_dto: CreatePaymentRequestDto) -> CreatePaymentResponseDto:
        try:
            sdk_request = PaymentMapper.to_sdk_request(request_dto)
            amount = sdk_request.order.amount_of_money.amount
            currency = sdk_request.order.amount_of_money.currency_code
            logger.info(f"Creating payment request for payment - Amount: {amount}; Currency: {currency}.")
            sdk_response = self._merchant_client.payments().create_payment(sdk_request)
            logger.info(f"Successful payment with payment id: {sdk_response.payment.id}.")

            return PaymentMapper.from_sdk_response(sdk_response)
        except Exception as ex:
            logger.error(f"Error occurred while creating payment: {str(ex)}")
            raise ExceptionMapper.map(ex)

    def capture_payment(self, request_dto):
        try:
            sdk_request = CapturePaymentMapper.to_sdk_request(request_dto)
            logger.info(f"Capture for payment - Id: {request_dto.id}; Amount: {sdk_request.amount}.")
            sdk_response = self._merchant_client.payments().capture_payment(request_dto.id, sdk_request)
            logger.info("Successful capture for payment.")

            return CapturePaymentMapper.from_sdk_response(sdk_response)
        except Exception as ex:
            logger.error(f"Error capturing payment: {str(ex)}")
            raise ExceptionMapper.map(ex)

    def refund_payment(self, request_dto):
        try:
            sdk_request = RefundPaymentMapper.to_sdk_request(request_dto)
            logger.info(f"Refund for payment - Id: {request_dto.id}; Amount: {sdk_request.amount_of_money.amount}.")
            sdk_response = self._merchant_client.payments().refund_payment(request_dto.id, sdk_request)
            logger.info("Successful refund for payment.")

            return RefundPaymentMapper.from_sdk_response(sdk_response)
        except Exception as ex:
            logger.error(f"Error refunding payment: {str(ex)}")
            raise ExceptionMapper.map(ex)

    def cancel_payment(self, request_dto):
        try:
            sdk_request = CancelPaymentMapper.to_sdk_request(request_dto)
            logger.info(f"Cancel for payment - Id: {request_dto.id}; Amount: {sdk_request.amount_of_money.amount}.")
            sdk_response = self._merchant_client.payments().cancel_payment(request_dto.id, sdk_request)
            logger.info("Successful cancel for payment.")

            return CancelPaymentMapper.from_sdk_response(sdk_response)
        except Exception as ex:
            logger.error(f"Error cancelling payment: {str(ex)}")
            raise ExceptionMapper.map(ex)

    def get_payment_details(self, id: str):
        try:
            logger.info(f"Get details for payment with id: {id}.")
            sdk_response = self._merchant_client.payments().get_payment_details(id)
            logger.info("Payment details retrieved successfully.")

            return PaymentDetailsMapper.from_sdk_response(sdk_response)
        except Exception as ex:
            logger.error(f"Error getting payment details: {str(ex)}")
            raise ExceptionMapper.map(ex)
