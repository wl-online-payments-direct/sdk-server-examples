from typing import Optional
from app.application.domain.payments.payment_details.payment_references import PaymentReferences
from onlinepayments.sdk.domain.payment_references import PaymentReferences as PaymentReferencesSdk

class PaymentReferencesMapper:

    @staticmethod
    def map_from_sdk_response(response: Optional[PaymentReferencesSdk]) -> Optional[PaymentReferences]:
        if response is None:
            return None

        return PaymentReferences(
            merchant_reference = response.merchant_reference,
            merchant_parameters = response.merchant_parameters
        )