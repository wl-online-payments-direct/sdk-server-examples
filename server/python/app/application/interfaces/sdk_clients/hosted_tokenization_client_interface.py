from abc import ABC, abstractmethod
from app.application.dtos.hosted_tokenization.response_dto import HostedTokenizationResponseDto

class HostedTokenizationClientInterface(ABC):

    @abstractmethod
    def init_hosted_tokenization(self) -> HostedTokenizationResponseDto:
        pass