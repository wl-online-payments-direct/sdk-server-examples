from typing import Optional
from app.application.domain.payments.payment_details.card_fraud_results import CardFraudResults
from onlinepayments.sdk.domain.card_fraud_results import CardFraudResults as CardFraudResultsSdk

class CardFraudResultsMapper:

    @staticmethod
    def map_from_sdk_response(response: Optional[CardFraudResultsSdk]) -> Optional[CardFraudResults]:
        if response is None:
            return None

        dto = CardFraudResults()
        dto.avs_result = response.avs_result
        dto.fraud_service_result = response.fraud_service_result
        dto.cvv_result = response.cvv_result

        return dto