from dataclasses import dataclass
from typing import Optional, Any

@dataclass
class AddressPersonal:
    additional_info: Optional[str] = None
    city: Optional[str] = None
    company_name: Optional[str] = None
    country_code: Optional[str] = None
    house_number: Optional[str] = None
    name: Optional[Any] = None
    state: Optional[str] = None
    street: Optional[str] = None
    zip: Optional[str] = None