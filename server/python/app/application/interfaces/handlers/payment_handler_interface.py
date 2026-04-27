from abc import ABC, abstractmethod
from app.application.domain.enums.payments.payment_method_type import PaymentMethodType
from app.application.dtos.create_payment.request_dto import CreatePaymentRequestDto

class PaymentHandlerInterface(ABC):

    @abstractmethod
    def supported_method(self) -> PaymentMethodType:
        pass

    @abstractmethod
    def handle(self, request_dto: CreatePaymentRequestDto):
        pass