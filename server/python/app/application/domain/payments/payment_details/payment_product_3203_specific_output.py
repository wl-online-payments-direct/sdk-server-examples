from dataclasses import dataclass
from typing import Optional

from app.application.domain.payments.payment_details.address_personal import AddressPersonal

@dataclass
class PaymentProduct3203SpecificOutput:
    billing_address: Optional[AddressPersonal] = None
    shipping_address: Optional[AddressPersonal] = None