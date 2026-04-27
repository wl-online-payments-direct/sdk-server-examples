from dataclasses import dataclass
from typing import Optional

@dataclass
class RateDetails:
    exchange_rate: Optional[float] = None
    inverted_exchange_rate: Optional[float] = None
    mark_up_rate: Optional[float] = None
    quotation_date_time: Optional[str] = None
    source: Optional[str] = None