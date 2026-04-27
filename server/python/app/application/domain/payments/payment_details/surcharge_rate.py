from dataclasses import dataclass
from typing import Optional

@dataclass
class SurchargeRate:
    ad_valorem_rate: Optional[float] = None
    specific_rate: Optional[int] = None
    surcharge_product_type_id: Optional[str] = None
    surcharge_product_type_version: Optional[str] = None