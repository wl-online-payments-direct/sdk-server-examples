from dataclasses import dataclass
from typing import Optional
from app.application.domain.enums.common.currency import Currency
from app.application.domain.enums.payment_links.action import Action
from app.application.domain.enums.payment_links.valid_for import ValidFor

@dataclass
class CreatePaymentLinkRequestDto:
    amount: Optional[float] = None
    currency: Optional[Currency] = None
    description: Optional[str] = None
    valid_for: Optional[ValidFor] = None
    action: Optional[Action] = None