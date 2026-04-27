from dataclasses import dataclass
from typing import Optional

@dataclass
class ThreeDSecureResults:
    acs_transaction_id: Optional[str] = None
    applied_exemption: Optional[str] = None
    authentication_status: Optional[str] = None
    cavv: Optional[str] = None
    challenge_indicator: Optional[str] = None
    ds_transaction_id: Optional[str] = None
    eci: Optional[str] = None
    exemption_engine_flow: Optional[str] = None
    flow: Optional[str] = None
    liability: Optional[str] = None
    scheme_eci: Optional[str] = None
    version: Optional[str] = None
    xid: Optional[str] = None