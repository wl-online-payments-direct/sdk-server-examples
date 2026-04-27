from dataclasses import dataclass
from typing import Optional

@dataclass
class PaymentProduct5001SpecificOutput:
    account_number: Optional[str] = None
    authorisation_code: Optional[str] = None
    liability: Optional[str] = None
    mobile_phone_number: Optional[str] = None
    operation_code: Optional[str] = None