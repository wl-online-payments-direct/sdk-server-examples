from abc import ABC, abstractmethod
from app.application.dtos.payment_link.request_dto import CreatePaymentLinkRequestDto
from app.application.dtos.payment_link.response_dto import CreatePaymentLinkResponseDto

class PaymentLinkClientInterface(ABC):

    @abstractmethod
    def create_payment_link(self, request_dto: CreatePaymentLinkRequestDto) -> CreatePaymentLinkResponseDto:
        pass