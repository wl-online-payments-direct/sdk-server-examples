from onlinepayments.sdk.domain.capture_payment_request import CapturePaymentRequest
from app.application.domain.enums.additional_payment_actions.status import AdditionalPaymentActionStatus
from app.application.domain.payments.status_output import StatusOutput
from app.application.dtos.additional_payment_actions.request_dto import AdditionalPaymentActionsRequestDto
from app.application.dtos.additional_payment_actions.response_dto import AdditionalPaymentActionsResponseDto

class CapturePaymentMapper:

    @staticmethod
    def to_sdk_request(dto: AdditionalPaymentActionsRequestDto) -> CapturePaymentRequest:
        request = CapturePaymentRequest()
        request.amount = dto.amount
        request.is_final = dto.is_final

        return request

    @staticmethod
    def from_sdk_response(response) -> AdditionalPaymentActionsResponseDto:
        response_dto = AdditionalPaymentActionsResponseDto()

        response_dto.id = getattr(response, 'id', None)

        status = getattr(response, 'status', None)
        response_dto.status = AdditionalPaymentActionStatus.try_from(status) if status else None

        status_output = StatusOutput()
        status_output_obj = getattr(response, 'status_output', None)
        status_output.status_code = getattr(status_output_obj, 'status_code', None)
        status_output.status_category = None

        response_dto.status_output = status_output

        return response_dto