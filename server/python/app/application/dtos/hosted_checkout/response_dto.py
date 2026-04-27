from dataclasses import dataclass
from typing import Optional

@dataclass
class CreateHostedCheckoutResponseDto:
    hosted_checkout_id: str
    redirect_url: str
    return_mac: Optional[str] = None
    amount: Optional[int] = None
    currency: Optional[str] = None