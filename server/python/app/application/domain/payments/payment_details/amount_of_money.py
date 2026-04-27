from dataclasses import dataclass
from typing import Optional


@dataclass
class AmountOfMoney:
    amount: Optional[float] = None
    currency_code: Optional[str] = None