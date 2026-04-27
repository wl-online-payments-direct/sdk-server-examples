from dataclasses import dataclass
from typing import Optional, List

from app.application.domain.payments.payment_details.api_error import APIError

@dataclass
class PaymentStatusOutput:
    errors: Optional[List[APIError]] = None
    is_authorized: Optional[bool] = None
    is_cancellable: Optional[bool] = None
    is_refundable: Optional[bool] = None
    status_category: Optional[str] = None
    status_code: Optional[int] = None
    status_code_change_date_time: Optional[str] = None