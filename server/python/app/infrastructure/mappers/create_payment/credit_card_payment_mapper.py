from onlinepayments.sdk.domain.card import Card
from onlinepayments.sdk.domain.card_payment_method_specific_input import CardPaymentMethodSpecificInput
from onlinepayments.sdk.domain.three_d_secure import ThreeDSecure
from app.application.dtos.create_payment.request_dto import CreatePaymentRequestDto

class CreditCardPaymentMapper:
    @staticmethod
    def to_sdk_request(dto: CreatePaymentRequestDto):
        if dto is None:
            return None

        card_data = dto.card
        card_input = CardPaymentMethodSpecificInput()
        card_input.payment_product_id = dto.payment_product_id

        card = Card()
        if card_data is not None:
            card.card_number = card_data.number
            card.cardholder_name = card_data.holder_name
            expiry_year = str(card_data.expiry_year or "")[-2:]
            card.expiry_date = f"{card_data.expiry_month}{expiry_year}"
            card.cvv = card_data.verification_code

        card_input.card = card

        three_ds = ThreeDSecure()
        three_ds.skip_authentication = True
        card_input.three_d_secure = three_ds

        return card_input