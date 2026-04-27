from dataclasses import dataclass
from typing import Optional
from app.application.domain.enums.common.currency import Currency
from app.application.domain.enums.common.status import Status

@dataclass
class CreatePaymentLinkResponseDto:
    redirect_url: Optional[str] = None
    payment_link_id: Optional[str] = None
    status: Optional[Status] = None
    amount: Optional[float] = None
    currency: Optional[Currency] = None