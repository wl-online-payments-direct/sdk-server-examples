from dataclasses import dataclass
from typing import Optional

from app.application.domain.payments.payment_details.customer_device_output import CustomerDeviceOutput

@dataclass
class CustomerOutput:
    device: Optional[CustomerDeviceOutput] = None