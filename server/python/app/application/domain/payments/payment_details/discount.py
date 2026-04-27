from dataclasses import dataclass
from typing import Optional

@dataclass
class Discount:
    amount: Optional[int] = None