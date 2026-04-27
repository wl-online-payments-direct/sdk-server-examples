from app.application.dtos.get_payment_details.response_dto import GetPaymentDetailsResponseDto
from app.presentation.models.get_payment_details.response import GetPaymentDetailsResponse

class PaymentDetailsPresentationMapper:

    @staticmethod
    def from_dto(dto: GetPaymentDetailsResponseDto) -> GetPaymentDetailsResponse:
        return GetPaymentDetailsResponse(
            id=dto.id,
            status=dto.status,
            status_output=dto.status_output,
            payment_output=dto.payment_output,
            hosted_checkout_specific_output=dto.hosted_checkout_specific_output,
            operations=dto.operations
        )