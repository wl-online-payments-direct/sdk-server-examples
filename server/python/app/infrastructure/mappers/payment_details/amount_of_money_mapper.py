from typing import Optional
from app.application.domain.payments.payment_details.amount_of_money import AmountOfMoney
from onlinepayments.sdk.domain.amount_of_money import AmountOfMoney as AmountOfMoneySdk

class AmountOfMoneyMapper:

    @staticmethod
    def map_from_sdk_response(response: Optional[AmountOfMoneySdk]) -> Optional[AmountOfMoney]:
        if response is None:
            return None

        dto = AmountOfMoney()
        dto.amount = response.amount
        dto.currency_code = response.currency_code

        return dto