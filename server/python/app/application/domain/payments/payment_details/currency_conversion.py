from dataclasses import dataclass
from typing import Optional, Any

from app.application.domain.payments.payment_details.dcc_proposal import DccProposal

@dataclass
class CurrencyConversion:
    accepted_by_user: Optional[bool] = None
    proposal: Optional[DccProposal] = None