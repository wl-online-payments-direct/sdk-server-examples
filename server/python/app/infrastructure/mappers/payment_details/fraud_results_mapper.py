from typing import Optional
from app.application.domain.payments.payment_details.fraud_result import FraudResults
from onlinepayments.sdk.domain.fraud_results import FraudResults as FraudResultsSdk

class FraudResultsMapper:

    @staticmethod
    def map_from_sdk_response(response: Optional[FraudResultsSdk]) -> Optional[FraudResults]:
        if response is None:
            return None

        dto = FraudResults()
        dto.fraud_service_result = response.fraud_service_result

        return dto