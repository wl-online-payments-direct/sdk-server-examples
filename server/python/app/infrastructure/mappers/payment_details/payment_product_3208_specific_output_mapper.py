from typing import Optional

from app.application.domain.payments.payment_details.payment_product_3208_specific_output import PaymentProduct3208SpecificOutput
from onlinepayments.sdk.domain.payment_product3208_specific_output import PaymentProduct3208SpecificOutput as PaymentProduct3208SpecificOutputSdk

class PaymentProduct3208SpecificOutputMapper:

    @staticmethod
    def map_from_sdk_response(
        response: Optional[PaymentProduct3208SpecificOutputSdk],
    ) -> Optional[PaymentProduct3208SpecificOutput]:
        if response is None:
            return None

        dto = PaymentProduct3208SpecificOutput()
        dto.buyer_compliant_bank_message = response.buyer_compliant_bank_message

        return dto