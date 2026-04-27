from dataclasses import dataclass
from typing import Optional

@dataclass
class GetPaymentProductIdResponseDto:
    payment_product_id: Optional[int] = None