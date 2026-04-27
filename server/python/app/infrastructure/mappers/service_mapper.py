from app.application.dtos.service.get_payment_product_id.request_dto import GetPaymentProductIdRequestDto
from app.application.dtos.service.get_payment_product_id.response_dto import GetPaymentProductIdResponseDto
from onlinepayments.sdk.domain.get_iin_details_request import GetIINDetailsRequest

class ServiceMapper:

    @staticmethod
    def to_sdk_request(request_dto: GetPaymentProductIdRequestDto) -> GetIINDetailsRequest:
        sdk_request = GetIINDetailsRequest()
        sdk_request.bin = request_dto.card_number[:6] if request_dto.card_number else None

        return sdk_request

    @staticmethod
    def from_sdk_response(sdk_response) -> GetPaymentProductIdResponseDto:
        return GetPaymentProductIdResponseDto(
            payment_product_id=sdk_response.payment_product_id
        )