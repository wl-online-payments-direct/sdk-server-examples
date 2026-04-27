from dataclasses import dataclass
from typing import Optional

@dataclass
class Address:
    additional_info: Optional[str] = None
    city: Optional[str] = None
    country_code: Optional[str] = None
    house_number: Optional[str] = None
    state: Optional[str] = None
    street: Optional[str] = None
    zip: Optional[str] = None