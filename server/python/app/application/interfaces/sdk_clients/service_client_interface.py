from abc import ABC, abstractmethod
from app.application.dtos.service.get_payment_product_id.request_dto import GetPaymentProductIdRequestDto
from app.application.dtos.service.get_payment_product_id.response_dto import GetPaymentProductIdResponseDto

class ServiceClientInterface(ABC):

    @abstractmethod
    def get_payment_product_id(self, request_dto: GetPaymentProductIdRequestDto) -> GetPaymentProductIdResponseDto:
        pass