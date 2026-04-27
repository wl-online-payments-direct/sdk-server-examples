from typing import Optional
from app.application.domain.payments.payment_details.protection_eligibility import ProtectionEligibility
from onlinepayments.sdk.domain.protection_eligibility import ProtectionEligibility as ProtectionEligibilitySdk

class ProtectionEligibilityMapper:

    @staticmethod
    def map_from_sdk_response(response: Optional[ProtectionEligibilitySdk]) -> Optional[ProtectionEligibility]:
        if response is None:
            return None

        dto = ProtectionEligibility()
        dto.eligibility = response.eligibility
        dto.type = response.type

        return dto