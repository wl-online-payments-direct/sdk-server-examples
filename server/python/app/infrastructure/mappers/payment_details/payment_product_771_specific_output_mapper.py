from typing import Optional
from app.application.domain.payments.payment_details.payment_product_771_specific_output import PaymentProduct771SpecificOutput
from onlinepayments.sdk.domain.payment_product771_specific_output import PaymentProduct771SpecificOutput as PaymentProduct771SpecificOutputSdk

class PaymentProduct771SpecificOutputMapper:

    @staticmethod
    def map_from_sdk_response(
        response: Optional[PaymentProduct771SpecificOutputSdk],
    ) -> Optional[PaymentProduct771SpecificOutput]:
        if response is None:
            return None

        return PaymentProduct771SpecificOutput(
            mandate_reference = response.mandate_reference
        )