from dataclasses import dataclass
from typing import Optional

@dataclass
class ExternalTokenLinked:
    computed_token: Optional[str] = None
    gts_computed_token: Optional[str] = None
    generated_token: Optional[str] = None