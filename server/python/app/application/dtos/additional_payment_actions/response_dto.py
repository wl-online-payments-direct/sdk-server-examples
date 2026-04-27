from dataclasses import dataclass
from typing import Optional
from app.application.domain.payments.status_output import StatusOutput

@dataclass
class AdditionalPaymentActionsResponseDto:
    id: Optional[str] = None
    status: Optional[str] = None
    status_output: Optional[StatusOutput] = None