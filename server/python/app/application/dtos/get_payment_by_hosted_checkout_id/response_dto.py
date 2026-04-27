from dataclasses import dataclass
from typing import Optional

@dataclass
class GetPaymentByHostedCheckoutIdResponseDto:
    status: Optional[str] = None
    payment_id: Optional[str] = None