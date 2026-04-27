from app.application.dtos.create_payment.request_dto import CreatePaymentRequestDto
from app.application.dtos.create_payment.response_dto import CreatePaymentResponseDto
from app.application.interfaces.services.payment_service_interface import PaymentServiceInterface
from app.application.exceptions.validation_exception import ValidationException

class PaymentService(PaymentServiceInterface):

    def __init__(self, payment_client, handlers: list):
        self._payment_client = payment_client
        self._handlers = handlers

    def create_payment(self, request_dto: CreatePaymentRequestDto) -> CreatePaymentResponseDto:
        handler = next(
            (h for h in self._handlers if h.supported_method() == request_dto.method),
            None
        )

        if not handler:
            raise ValidationException([f"No handler found for payment method: {request_dto.method}"])
        
        return handler.handle(request_dto)

    def capture_payment(self, request_dto):
        return self._payment_client.capture_payment(request_dto)

    def refund_payment(self, request_dto):
        return self._payment_client.refund_payment(request_dto)

    def cancel_payment(self, request_dto):
        return self._payment_client.cancel_payment(request_dto)

    def get_payment_details(self, id: str):
        return self._payment_client.get_payment_details(id)