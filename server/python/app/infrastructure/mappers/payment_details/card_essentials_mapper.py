from typing import Optional
from app.application.domain.payments.payment_details.card_essentials import CardEssentials
from onlinepayments.sdk.domain.card_essentials import CardEssentials as CardEssentialsSdk

class CardEssentialsMapper:

    @staticmethod
    def map_from_sdk_response(response: Optional[CardEssentialsSdk]) -> Optional[CardEssentials]:
        if response is None:
            return None

        dto = CardEssentials()
        dto.country_code = response.country_code
        dto.card_number = response.card_number
        dto.expiry_date = response.expiry_date
        dto.bin = response.bin

        return dto