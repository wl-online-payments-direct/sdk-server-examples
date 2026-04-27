from app.application.domain.enums.common.language import Language
from app.application.dtos.hosted_checkout.request_dto import CreateHostedCheckoutRequestDto
from app.application.dtos.hosted_checkout.response_dto import CreateHostedCheckoutResponseDto
from app.application.dtos.get_payment_by_hosted_checkout_id.response_dto import GetPaymentByHostedCheckoutIdResponseDto
from app.presentation.models.hosted_checkout.request import HostedCheckoutRequest
from app.presentation.models.hosted_checkout.response import HostedCheckoutResponse

SMALLEST_UNIT = 100

class HostedCheckoutPresentationMapper:

    @staticmethod
    def to_dto(request: HostedCheckoutRequest) -> CreateHostedCheckoutRequestDto:
        return CreateHostedCheckoutRequestDto(
            amount=int(request.amount * SMALLEST_UNIT),
            currency=request.currency,
            language=Language(request.language),
            billing_address=request.billing_address,
            shipping_address=request.shipping_address,
            redirect_url=request.redirect_url
        )

    @staticmethod
    def from_dto(response_dto: CreateHostedCheckoutResponseDto) -> HostedCheckoutResponse:
        return HostedCheckoutResponse(
            hosted_checkout_id=response_dto.hosted_checkout_id,
            redirect_url=response_dto.redirect_url,
            return_mac=response_dto.return_mac,
            amount=response_dto.amount / SMALLEST_UNIT,
            currency=response_dto.currency
        )

    @staticmethod
    def from_get_payment_dto(response_dto: GetPaymentByHostedCheckoutIdResponseDto):
        return {
            "status": response_dto.status,
            "payment_id": response_dto.payment_id
        }