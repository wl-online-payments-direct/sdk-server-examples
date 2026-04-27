from dataclasses import dataclass
from typing import Optional
from app.application.domain.payments.payment_details.acquirer_selection_information import AcquirerSelectionInformation

@dataclass
class AcquirerInformation:
    acquirer_selection_information: Optional[AcquirerSelectionInformation] = None
    name: Optional[str] = None