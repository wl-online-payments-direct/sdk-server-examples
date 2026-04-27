from dataclasses import dataclass
from typing import Optional

@dataclass
class PaymentProduct840CustomerAccount:
    account_id: Optional[str] = None
    company_name: Optional[str] = None
    country_code: Optional[str] = None
    customer_account_status: Optional[str] = None
    customer_address_status: Optional[str] = None
    first_name: Optional[str] = None
    payer_id: Optional[str] = None
    surname: Optional[str] = None