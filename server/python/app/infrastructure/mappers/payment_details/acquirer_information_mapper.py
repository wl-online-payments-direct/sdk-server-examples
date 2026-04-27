from typing import Optional
from app.application.domain.payments.payment_details.acquirer_information import AcquirerInformation
from app.infrastructure.mappers.payment_details.acquirer_selection_information_mapper import AcquirerSelectionInformationMapper
from onlinepayments.sdk.domain.acquirer_information import AcquirerInformation as AcquirerInformationSdk

class AcquirerInformationMapper:

    @staticmethod
    def map_from_sdk_response(response: Optional[AcquirerInformationSdk]) -> Optional[AcquirerInformation]:
        if response is None:
            return None

        dto = AcquirerInformation()
        dto.acquirer_selection_information = AcquirerSelectionInformationMapper.map_from_sdk_response(response.acquirer_selection_information)
        dto.name = response.name

        return dto