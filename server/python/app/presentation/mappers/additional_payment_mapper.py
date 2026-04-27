from app.application.domain.enums.common.currency import Currency
from app.application.dtos.additional_payment_actions.request_dto import AdditionalPaymentActionsRequestDto
from app.application.dtos.additional_payment_actions.response_dto import AdditionalPaymentActionsResponseDto
from app.presentation.models.additional_payment_actions.request import AdditionalPaymentActionsRequest
from app.presentation.models.additional_payment_actions.response import AdditionalPaymentActionsResponse

SMALLEST_UNIT = 100

class AdditionalPaymentActionsPresentationMapper:

    @staticmethod
    def to_dto(request: AdditionalPaymentActionsRequest, id: str) -> AdditionalPaymentActionsRequestDto:
        return AdditionalPaymentActionsRequestDto(
            id=id,
            amount=int(float(request.amount) * SMALLEST_UNIT) if request.amount else None,
            currency=Currency(request.currency) if request.currency else None,
            is_final=request.is_final
        )

    @staticmethod
    def from_dto(response_dto: AdditionalPaymentActionsResponseDto) -> AdditionalPaymentActionsResponse:
        return AdditionalPaymentActionsResponse(
            id=response_dto.id,
            status=response_dto.status.value if response_dto.status else None,
            status_output={
                "statusCode": response_dto.status_output.status_code,
                "statusCategory": response_dto.status_output.status_category.value if response_dto.status_output and response_dto.status_output.status_category else None
            } if response_dto.status_output else None
        )