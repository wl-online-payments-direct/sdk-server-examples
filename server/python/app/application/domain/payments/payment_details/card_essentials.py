from dataclasses import dataclass
from typing import Optional

@dataclass
class CardEssentials:
    bin: Optional[str] = None
    card_number: Optional[str] = None
    country_code: Optional[str] = None
    expiry_date: Optional[str] = None