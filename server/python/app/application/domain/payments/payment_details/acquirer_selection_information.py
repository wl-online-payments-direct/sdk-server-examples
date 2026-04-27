from dataclasses import dataclass
from typing import Optional

@dataclass
class AcquirerSelectionInformation:
    fallback_level: Optional[str] = None
    result: Optional[str] = None
    rule_name: Optional[str] = None