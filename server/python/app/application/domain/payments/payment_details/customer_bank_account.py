from dataclasses import dataclass
from typing import Optional

@dataclass
class CustomerBankAccount:
    account_holder_name: Optional[str] = None
    bic: Optional[str] = None
    iban: Optional[str] = None