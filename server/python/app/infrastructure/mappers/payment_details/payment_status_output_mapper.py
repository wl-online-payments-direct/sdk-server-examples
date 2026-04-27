from typing import Optional, List
from app.application.domain.payments.payment_details.payment_status_output import PaymentStatusOutput
from app.application.domain.payments.payment_details.api_error import APIError
from onlinepayments.sdk.domain.payment_status_output import PaymentStatusOutput as PaymentStatusOutputSdk
from onlinepayments.sdk.domain.api_error import APIError as APIErrorSdk
from app.infrastructure.mappers.payment_details.api_error_mapper import ApiErrorMapper

class PaymentStatusOutputMapper:

    @staticmethod
    def map_from_sdk_response(response: Optional[PaymentStatusOutputSdk]) -> Optional[PaymentStatusOutput]:
        if response is None:
            return None

        return PaymentStatusOutput(
            is_authorized = response.is_authorized,
            is_cancellable = response.is_cancellable,
            is_refundable = response.is_refundable,
            status_category = response.status_category,
            status_code = response.status_code,
            status_code_change_date_time = response.status_code_change_date_time,
            errors = PaymentStatusOutputMapper.map_list(response.errors)
        )

    @staticmethod
    def map_list(errors: Optional[List[APIErrorSdk]]) -> Optional[List[APIError]]:
        if errors is None:
            return None
        return [ApiErrorMapper.map_from_sdk_response(e) for e in errors]