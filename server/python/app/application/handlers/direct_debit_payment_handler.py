from app.application.domain.enums.payments.payment_method_type import PaymentMethodType
from app.application.dtos.create_payment.request_dto import CreatePaymentRequestDto
from app.application.interfaces.handlers.payment_handler_interface import PaymentHandlerInterface

DIRECT_DEBIT_PRODUCT_ID = 771

class DirectDebitPaymentHandler(PaymentHandlerInterface):

    def __init__(self, payment_client, mandate_client):
        self._payment_client = payment_client
        self._mandate_client = mandate_client

    def supported_method(self) -> PaymentMethodType:
        return PaymentMethodType.DIRECT_DEBIT

    def handle(self, request_dto: CreatePaymentRequestDto):
        self._ensure_mandate(request_dto)
        request_dto.payment_product_id = DIRECT_DEBIT_PRODUCT_ID

        return self._payment_client.create_payment(request_dto)

    def _ensure_mandate(self, request_dto: CreatePaymentRequestDto):
        mandate = request_dto.mandate
        mandate_reference = mandate.mandate_reference if mandate else None

        existing_mandate = None
        if mandate_reference:
            existing_mandate = self._mandate_client.get_mandate(mandate_reference)

        if existing_mandate is None:
            new_mandate = self._mandate_client.create_mandate(request_dto)
            request_dto.mandate = new_mandate
        else:
            if request_dto.mandate:
                request_dto.mandate.mandate_reference = existing_mandate.mandate_reference