from dataclasses import dataclass
from typing import Optional

@dataclass
class GetMandateResponseDto:
    mandate_reference: Optional[str] = None