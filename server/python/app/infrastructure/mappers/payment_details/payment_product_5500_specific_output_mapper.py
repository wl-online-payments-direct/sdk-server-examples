from typing import Optional
from app.application.domain.payments.payment_details.payment_product_5500_specific_output import PaymentProduct5500SpecificOutput
from onlinepayments.sdk.domain.payment_product5500_specific_output import PaymentProduct5500SpecificOutput as PaymentProduct5500SpecificOutputSdk

class PaymentProduct5500SpecificOutputMapper:

    @staticmethod
    def map_from_sdk_response(
        response: Optional[PaymentProduct5500SpecificOutputSdk],
    ) -> Optional[PaymentProduct5500SpecificOutput]:
        if response is None:
            return None

        return PaymentProduct5500SpecificOutput(
            payment_reference = response.payment_reference,
            payment_end_date = response.payment_end_date,
            payment_start_date = response.payment_start_date,
            entity_id = response.entity_id,
        )