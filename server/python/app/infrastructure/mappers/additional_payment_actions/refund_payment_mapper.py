from onlinepayments.sdk.domain.refund_request import RefundRequest
from app.application.domain.enums.additional_payment_actions.status import AdditionalPaymentActionStatus
from app.application.domain.enums.common.status_category import StatusCategory
from app.application.domain.payments.status_output import StatusOutput
from app.application.dtos.additional_payment_actions.request_dto import AdditionalPaymentActionsRequestDto
from app.application.dtos.additional_payment_actions.response_dto import AdditionalPaymentActionsResponseDto
from app.infrastructure.mappers.additional_payment_actions.amount_of_money_mapper import AmountOfMoneyMapper

class RefundPaymentMapper:

    @staticmethod
    def to_sdk_request(dto: AdditionalPaymentActionsRequestDto) -> RefundRequest:
        request = RefundRequest()
        request.amount_of_money = AmountOfMoneyMapper.to_sdk_amount_of_money(dto)

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

        status_category = getattr(status_output_obj, 'status_category', None)
        status_output.status_category = StatusCategory.try_from(status_category) if status_category else None

        response_dto.status_output = status_output

        return response_dto