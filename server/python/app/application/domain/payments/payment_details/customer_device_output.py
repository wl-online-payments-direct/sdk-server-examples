from dataclasses import dataclass
from typing import Optional

@dataclass
class CustomerDeviceOutput:
    ip_address_country_code: Optional[str] = None