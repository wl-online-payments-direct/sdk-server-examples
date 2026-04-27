from app.application.domain.enums.common.currency import Currency
from app.application.domain.enums.payment_links.action import Action
from app.application.domain.enums.payment_links.valid_for import ValidFor
from app.application.dtos.payment_link.request_dto import CreatePaymentLinkRequestDto
from app.application.dtos.payment_link.response_dto import CreatePaymentLinkResponseDto
from app.presentation.models.payment_link.request import PaymentLinkRequest
from app.presentation.models.payment_link.response import PaymentLinkResponse

SMALLEST_UNIT = 100

class PaymentLinkPresentationMapper:

    @staticmethod
    def to_dto(request: PaymentLinkRequest) -> CreatePaymentLinkRequestDto:
        return CreatePaymentLinkRequestDto(
            amount=float(request.amount),
            currency=Currency(request.currency),
            description=request.description,
            valid_for=ValidFor(int(request.valid_for)),
            action=Action(request.action)
        )

    @staticmethod
    def from_dto(response_dto: CreatePaymentLinkResponseDto) -> PaymentLinkResponse:
        return PaymentLinkResponse(
            payment_link_id=response_dto.payment_link_id,
            redirect_url=response_dto.redirect_url or '',
            status=response_dto.status.value if response_dto.status else None,
            amount=response_dto.amount if response_dto.status else None,
            currency=response_dto.currency.value if response_dto.currency else None
        )