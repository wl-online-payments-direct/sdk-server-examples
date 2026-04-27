from app.application.dtos.hosted_tokenization.response_dto import HostedTokenizationResponseDto
from app.application.interfaces.sdk_clients.hosted_tokenization_client_interface import HostedTokenizationClientInterface
from app.application.interfaces.services.hosted_tokenization_service_interface import HostedTokenizationServiceInterface

class HostedTokenizationService(HostedTokenizationServiceInterface):

    def __init__(self, hosted_tokenization_client: HostedTokenizationClientInterface):
        self._client = hosted_tokenization_client

    def init_hosted_tokenization(self) -> HostedTokenizationResponseDto:
        return self._client.init_hosted_tokenization()