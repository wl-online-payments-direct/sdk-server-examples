from app.application.domain.enums.payments.payment_method_type import PaymentMethodType
from app.application.dtos.create_payment.request_dto import CreatePaymentRequestDto
from app.application.dtos.service.get_payment_product_id.request_dto import GetPaymentProductIdRequestDto
from app.application.interfaces.handlers.payment_handler_interface import PaymentHandlerInterface

class CreditCardPaymentHandler(PaymentHandlerInterface):

    def __init__(self, payment_client, service_client):
        self._payment_client = payment_client
        self._service_client = service_client

    def supported_method(self) -> PaymentMethodType:
        return PaymentMethodType.CREDIT_CARD

    def handle(self, request_dto: CreatePaymentRequestDto):
        get_product_id_request = GetPaymentProductIdRequestDto(
            card_number=request_dto.card.number if request_dto.card else None
        )
        product_id_response = self._service_client.get_payment_product_id(get_product_id_request)
        request_dto.payment_product_id = product_id_response.payment_product_id

        return self._payment_client.create_payment(request_dto)