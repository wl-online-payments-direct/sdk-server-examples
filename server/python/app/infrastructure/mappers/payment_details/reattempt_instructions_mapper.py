from typing import Optional
from app.application.domain.payments.payment_details.reattempt_instructions import ReattemptInstructions
from onlinepayments.sdk.domain.reattempt_instructions import ReattemptInstructions as ReattemptInstructionsSdk
from app.infrastructure.mappers.payment_details.reattempt_instructions_conditions_mapper import ReattemptInstructionsConditionsMapper

class ReattemptInstructionsMapper:

    @staticmethod
    def map_from_sdk_response(response: Optional[ReattemptInstructionsSdk]) -> Optional[ReattemptInstructions]:
        if response is None:
            return None

        dto = ReattemptInstructions()
        dto.conditions = ReattemptInstructionsConditionsMapper.map_from_sdk_response(response.conditions)
        dto.frozen_period = response.frozen_period
        dto.indicator = response.indicator

        return dto