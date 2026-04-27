from dataclasses import dataclass
from typing import Optional
from app.application.domain.enums.common.currency import Currency

@dataclass
class AdditionalPaymentActionsRequestDto:
    id: str
    amount: Optional[int] = None
    currency: Optional[Currency] = None
    is_final: Optional[bool] = None