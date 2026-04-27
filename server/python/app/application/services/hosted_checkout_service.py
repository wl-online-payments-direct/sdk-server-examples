from app.application.dtos.hosted_checkout.request_dto import CreateHostedCheckoutRequestDto
from app.application.dtos.hosted_checkout.response_dto import CreateHostedCheckoutResponseDto
from app.application.dtos.get_payment_by_hosted_checkout_id.response_dto import GetPaymentByHostedCheckoutIdResponseDto
from app.application.interfaces.sdk_clients.hosted_checkout_client_interface import HostedCheckoutClientInterface
from app.application.interfaces.services.hosted_checkout_service_interface import HostedCheckoutServiceInterface

class HostedCheckoutService(HostedCheckoutServiceInterface):

    def __init__(self, hosted_checkout_client: HostedCheckoutClientInterface):
        self._client = hosted_checkout_client

    def create_hosted_checkout(self, request_dto: CreateHostedCheckoutRequestDto) -> CreateHostedCheckoutResponseDto:
        response_dto = self._client.create_hosted_checkout(request_dto)

        response_dto.amount = request_dto.amount
        response_dto.currency = request_dto.currency

        return response_dto

    def get_payment_by_hosted_checkout_id(self, id: str) -> GetPaymentByHostedCheckoutIdResponseDto:
        return self._client.get_payment_by_hosted_checkout_id(id)