from typing import Optional
from app.application.domain.payments.payment_details.payment_product_5001_specific_output import PaymentProduct5001SpecificOutput
from onlinepayments.sdk.domain.payment_product5001_specific_output import PaymentProduct5001SpecificOutput as PaymentProduct5001SpecificOutputSdk

class PaymentProduct5001SpecificOutputMapper:

    @staticmethod
    def map_from_sdk_response(
        response: Optional[PaymentProduct5001SpecificOutputSdk],
    ) -> Optional[PaymentProduct5001SpecificOutput]:
        if response is None:
            return None

        return PaymentProduct5001SpecificOutput(
            liability = response.liability,
            account_number = response.account_number,
            authorisation_code = response.authorisation_code,
            operation_code = response.operation_code,
            mobile_phone_number = response.mobile_phone_number,
        )