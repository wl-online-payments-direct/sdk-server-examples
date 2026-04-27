from dataclasses import dataclass
from typing import Optional

@dataclass
class FraudResults:
    fraud_service_result: Optional[str] = None