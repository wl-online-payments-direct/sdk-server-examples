from typing import Optional
from app.application.domain.payments.payment_details.operation_payment_references import OperationPaymentReferences
from onlinepayments.sdk.domain.operation_payment_references import OperationPaymentReferences as OperationPaymentReferencesSdk

class OperationPaymentReferencesMapper:

    @staticmethod
    def map_from_sdk_response(response: Optional[OperationPaymentReferencesSdk]) -> OperationPaymentReferences:

        dto = OperationPaymentReferences()
        dto.merchant_reference = response.merchant_reference

        return dto