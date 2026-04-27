from typing import Optional
from app.application.domain.payments.payment_details.discount import Discount
from onlinepayments.sdk.domain.discount import Discount as DiscountSdk

class DiscountMapper:

    @staticmethod
    def map_from_sdk_response(response: Optional[DiscountSdk]) -> Optional[Discount]:
        if response is None:
            return None

        dto = Discount()
        dto.amount = response.amount

        return dto