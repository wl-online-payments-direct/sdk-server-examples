from typing import Optional
from app.application.domain.payments.payment_details.rate_details import RateDetails
from onlinepayments.sdk.domain.rate_details import RateDetails as RateDetailsSdk

class RateDetailsMapper:

    @staticmethod
    def map_from_sdk_response(response: Optional[RateDetailsSdk]) -> Optional[RateDetails]:
        if response is None:
            return None

        dto = RateDetails()
        dto.source = response.source
        dto.exchange_rate = response.exchange_rate
        dto.inverted_exchange_rate = response.inverted_exchange_rate
        dto.mark_up_rate = response.mark_up_rate
        dto.quotation_date_time = response.quotation_date_time

        return dto