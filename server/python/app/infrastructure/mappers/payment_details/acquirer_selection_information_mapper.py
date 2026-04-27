from typing import Optional
from app.application.domain.payments.payment_details.acquirer_selection_information import AcquirerSelectionInformation
from onlinepayments.sdk.domain.acquirer_selection_information import AcquirerSelectionInformation as AcquirerSelectionInformationSdk

class AcquirerSelectionInformationMapper:

    @staticmethod
    def map_from_sdk_response(response: Optional[AcquirerSelectionInformationSdk]) -> Optional[AcquirerSelectionInformation]:
        if response is None:
            return None

        dto = AcquirerSelectionInformation()
        dto.fallback_level = response.fallback_level
        dto.rule_name = response.rule_name
        dto.result = response.result

        return dto