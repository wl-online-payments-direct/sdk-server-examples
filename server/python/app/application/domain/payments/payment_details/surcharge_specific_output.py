from dataclasses import dataclass
from typing import Optional

from app.application.domain.payments.payment_details.amount_of_money import AmountOfMoney
from app.application.domain.payments.payment_details.surcharge_rate import SurchargeRate

@dataclass
class SurchargeSpecificOutput:
    mode: Optional[str] = None
    surcharge_amount: Optional[AmountOfMoney] = None
    surcharge_rate: Optional[SurchargeRate] = None