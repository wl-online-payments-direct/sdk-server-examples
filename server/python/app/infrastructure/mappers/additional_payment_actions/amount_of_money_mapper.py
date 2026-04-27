from onlinepayments.sdk.domain.amount_of_money import AmountOfMoney
from app.application.dtos.additional_payment_actions.request_dto import AdditionalPaymentActionsRequestDto

class AmountOfMoneyMapper:

    @staticmethod
    def to_sdk_amount_of_money(dto: AdditionalPaymentActionsRequestDto):
        if dto.amount is None or dto.currency is None:
            return None

        amount_of_money = AmountOfMoney()
        amount_of_money.amount = dto.amount
        amount_of_money.currency_code = dto.currency if isinstance(dto.currency, str) else dto.currency.value

        return amount_of_money