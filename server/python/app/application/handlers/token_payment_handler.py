from app.application.domain.enums.payments.payment_method_type import PaymentMethodType
from app.application.dtos.create_payment.request_dto import CreatePaymentRequestDto
from app.application.interfaces.handlers.payment_handler_interface import PaymentHandlerInterface

class TokenPaymentHandler(PaymentHandlerInterface):

    def __init__(self, payment_client):
        self._payment_client = payment_client

    def supported_method(self) -> PaymentMethodType:
        return PaymentMethodType.TOKEN

    def handle(self, request_dto: CreatePaymentRequestDto):
        return self._payment_client.create_payment(request_dto)