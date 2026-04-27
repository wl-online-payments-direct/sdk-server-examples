from app.application.dtos.payment_link.request_dto import CreatePaymentLinkRequestDto
from app.application.dtos.payment_link.response_dto import CreatePaymentLinkResponseDto
from app.application.interfaces.sdk_clients.payment_link_client_interface import PaymentLinkClientInterface
from app.application.interfaces.services.payment_link_service_interface import PaymentLinkServiceInterface

class PaymentLinkService(PaymentLinkServiceInterface):

    def __init__(self, payment_link_client: PaymentLinkClientInterface):
        self._client = payment_link_client

    def create_payment_link(self, request_dto: CreatePaymentLinkRequestDto) -> CreatePaymentLinkResponseDto:
        response_dto = self._client.create_payment_link(request_dto)

        response_dto.amount = request_dto.amount
        response_dto.currency = request_dto.currency

        return response_dto