from onlinepayments.sdk.domain.card_payment_method_specific_input import CardPaymentMethodSpecificInput
from onlinepayments.sdk.domain.three_d_secure import ThreeDSecure
from app.application.dtos.create_payment.request_dto import CreatePaymentRequestDto

class TokenizedPaymentMapper:
    @staticmethod
    def to_sdk_request(dto: CreatePaymentRequestDto):
        if dto is None:
            return None

        card_input = CardPaymentMethodSpecificInput()
        three_ds = ThreeDSecure()
        three_ds.skip_authentication = True
        card_input.three_d_secure = three_ds

        return card_input