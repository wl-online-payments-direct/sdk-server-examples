from dataclasses import dataclass
from typing import Optional

from app.application.domain.payments.payment_details.reattempt_instructions_conditions import ReattemptInstructionsConditions

@dataclass
class ReattemptInstructions:
    conditions: Optional[ReattemptInstructionsConditions] = None
    frozen_period: Optional[int] = None
    indicator: Optional[str] = None