from typing import Optional
from app.application.domain.payments.payment_details.reattempt_instructions_conditions import ReattemptInstructionsConditions
from onlinepayments.sdk.domain.reattempt_instructions_conditions import ReattemptInstructionsConditions as ReattemptInstructionsConditionsSdk

class ReattemptInstructionsConditionsMapper:

    @staticmethod
    def map_from_sdk_response(response: Optional[ReattemptInstructionsConditionsSdk]) -> Optional[ReattemptInstructionsConditions]:
        if response is None:
            return None

        dto = ReattemptInstructionsConditions()
        dto.max_attempts = response.max_attempts
        dto.max_delay = response.max_delay

        return dto