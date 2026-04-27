from dataclasses import dataclass
from typing import Optional

from app.application.domain.payments.payment_details.amount_of_money import AmountOfMoney
from app.application.domain.payments.payment_details.rate_details import RateDetails

@dataclass
class DccProposal:
    base_amount: Optional[AmountOfMoney] = None
    disclaimer_display: Optional[str] = None
    disclaimer_receipt: Optional[str] = None
    rate: Optional[RateDetails] = None
    target_amount: Optional[AmountOfMoney] = None