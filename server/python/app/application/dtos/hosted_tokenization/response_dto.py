from dataclasses import dataclass
from typing import Optional

@dataclass
class HostedTokenizationResponseDto:
    hosted_tokenization_id: Optional[str] = None
    hosted_tokenization_url: Optional[str] = None