from typing import Optional
from app.application.domain.payments.payment_details.external_token_linked import ExternalTokenLinked
from onlinepayments.sdk.domain.external_token_linked import ExternalTokenLinked as ExternalTokenLinkedSdk

class ExternalTokenLinkedMapper:

    @staticmethod
    def map_from_sdk_response(response: Optional[ExternalTokenLinkedSdk]) -> Optional[ExternalTokenLinked]:
        if response is None:
            return None

        dto = ExternalTokenLinked()
        dto.computed_token = response.computed_token
        dto.generated_token = response.generated_token
        dto.gts_computed_token = response.gts_computed_token

        return dto