from dataclasses import dataclass
from typing import Optional

@dataclass
class ProtectionEligibility:
    eligibility: Optional[str] = None
    type: Optional[str] = None