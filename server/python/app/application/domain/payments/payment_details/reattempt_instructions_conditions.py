from dataclasses import dataclass
from typing import Optional

@dataclass
class ReattemptInstructionsConditions:
    max_attempts: Optional[int] = None
    max_delay: Optional[int] = None