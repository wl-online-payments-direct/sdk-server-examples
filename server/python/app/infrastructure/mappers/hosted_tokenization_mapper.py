from onlinepayments.sdk.domain.create_hosted_tokenization_response import CreateHostedTokenizationResponse
from app.application.dtos.hosted_tokenization.response_dto import HostedTokenizationResponseDto

class HostedTokenizationMapper:

    @staticmethod
    def from_sdk_response(response: CreateHostedTokenizationResponse) -> HostedTokenizationResponseDto:
        return HostedTokenizationResponseDto(
            hosted_tokenization_id=response.hosted_tokenization_id if response else None,
            hosted_tokenization_url=response.hosted_tokenization_url if response else None
        )