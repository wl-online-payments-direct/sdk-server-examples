from typing import Optional
from app.application.domain.payments.payment_details.api_error import APIError
from onlinepayments.sdk.domain.api_error import APIError as APIErrorSdk

class ApiErrorMapper:

    @staticmethod
    def map_from_sdk_response(response: Optional[APIErrorSdk]) -> Optional[APIError]:
        if response is None:
            return None

        dto = APIError()
        dto.message = response.message
        dto.error_code = response.error_code
        dto.property_name = response.property_name
        dto.http_status_code = response.http_status_code
        dto.retriable = response.retriable
        dto.category = response.category
        dto.id = response.id

        return dto