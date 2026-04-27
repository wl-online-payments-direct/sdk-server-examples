from app.application.dtos.hosted_tokenization.response_dto import HostedTokenizationResponseDto
from app.presentation.models.hosted_tokenization.response import HostedTokenizationResponse

class HostedTokenizationPresentationMapper:

    @staticmethod
    def from_dto(response_dto: HostedTokenizationResponseDto) -> HostedTokenizationResponse:
        return HostedTokenizationResponse(
            hosted_tokenization_id=response_dto.hosted_tokenization_id,
            hosted_tokenization_url=response_dto.hosted_tokenization_url
        )