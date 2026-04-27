from abc import ABC, abstractmethod

from app.application.dtos.additional_payment_actions.response_dto import AdditionalPaymentActionsResponseDto
from app.application.dtos.get_payment_details.response_dto import GetPaymentDetailsResponseDto
from app.application.dtos.create_payment.request_dto import CreatePaymentRequestDto
from app.application.dtos.create_payment.response_dto import CreatePaymentResponseDto

class PaymentServiceInterface(ABC):

    @abstractmethod
    def create_payment(self, request_dto: CreatePaymentRequestDto) -> CreatePaymentResponseDto:
        pass

    @abstractmethod
    def capture_payment(self, request_dto) -> AdditionalPaymentActionsResponseDto:
        pass

    @abstractmethod
    def refund_payment(self, request_dto) -> AdditionalPaymentActionsResponseDto:
        pass

    @abstractmethod
    def cancel_payment(self, request_dto) -> AdditionalPaymentActionsResponseDto:
        pass

    @abstractmethod
    def get_payment_details(self, id: str) -> GetPaymentDetailsResponseDto:
        pass