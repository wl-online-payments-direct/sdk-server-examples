from dataclasses import dataclass
from typing import Optional

@dataclass
class OperationPaymentReferences:
    merchant_reference: Optional[str] = None