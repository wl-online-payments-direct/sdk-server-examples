from dataclasses import dataclass
from typing import Optional

@dataclass
class MobilePaymentData:
    dpan: Optional[str] = None
    expiry_date: Optional[str] = None