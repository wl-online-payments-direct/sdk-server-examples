from dataclasses import dataclass
from typing import Optional

@dataclass
class PaymentProduct5500SpecificOutput:
    entity_id: Optional[str] = None
    payment_end_date: Optional[str] = None
    payment_reference: Optional[str] = None
    payment_start_date: Optional[str] = None