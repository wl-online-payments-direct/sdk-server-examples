from typing import Optional

from app.application.domain.payments.payment_details.payment_product_5402_specific_output import PaymentProduct5402SpecificOutput
from onlinepayments.sdk.domain.payment_product5402_specific_output import PaymentProduct5402SpecificOutput as PaymentProduct5402SpecificOutputSdk

class PaymentProduct5402SpecificOutputMapper:

    @staticmethod
    def map_from_sdk_response(
        response: Optional[PaymentProduct5402SpecificOutputSdk],
    ) -> Optional[PaymentProduct5402SpecificOutput]:
        if response is None:
            return None

        return PaymentProduct5402SpecificOutput(
            brand = response.brand
        )