from dataclasses import dataclass
from typing import Optional

@dataclass
class PaymentReferences:
    merchant_reference: Optional[str] = None
    merchant_parameters: Optional[str] = None