from dataclasses import dataclass
from typing import Optional

@dataclass
class GetPaymentProductIdRequestDto:
    card_number: Optional[str] = None