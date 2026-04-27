from dataclasses import dataclass
from typing import Optional

@dataclass
class CardFraudResults:
    fraud_service_result: Optional[str] = None
    avs_result: Optional[str] = None
    cvv_result: Optional[str] = None