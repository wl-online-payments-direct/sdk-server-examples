from abc import ABC, abstractmethod
from app.application.dtos.hosted_checkout.request_dto import CreateHostedCheckoutRequestDto
from app.application.dtos.hosted_checkout.response_dto import CreateHostedCheckoutResponseDto
from app.application.dtos.get_payment_by_hosted_checkout_id.response_dto import GetPaymentByHostedCheckoutIdResponseDto

class HostedCheckoutClientInterface(ABC):

    @abstractmethod
    def create_hosted_checkout(self, request_dto: CreateHostedCheckoutRequestDto) -> CreateHostedCheckoutResponseDto:
        pass

    @abstractmethod
    def get_payment_by_hosted_checkout_id(self, id: str) -> GetPaymentByHostedCheckoutIdResponseDto:
        pass