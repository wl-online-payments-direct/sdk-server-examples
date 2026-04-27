from typing import Optional
from app.application.domain.payments.payment_details.payment_product_3209_specific_output import PaymentProduct3209SpecificOutput
from onlinepayments.sdk.domain.payment_product3209_specific_output import PaymentProduct3209SpecificOutput as PaymentProduct3209SpecificOutputSdk

class PaymentProduct3209SpecificOutputMapper:

    @staticmethod
    def map_from_sdk_response(
        response: Optional[PaymentProduct3209SpecificOutputSdk],
    ) -> Optional[PaymentProduct3209SpecificOutput]:
        if response is None:
            return None

        dto = PaymentProduct3209SpecificOutput()
        dto.buyer_compliant_bank_message = response.buyer_compliant_bank_message

        return dto