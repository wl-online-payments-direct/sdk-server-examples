from dataclasses import dataclass
from typing import Optional

@dataclass
class HostedCheckoutSpecificOutput:
    hosted_checkout_id: Optional[str] = None
    variant: Optional[str] = None