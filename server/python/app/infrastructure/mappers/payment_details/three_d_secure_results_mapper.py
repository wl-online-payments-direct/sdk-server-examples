from typing import Optional
from app.application.domain.payments.payment_details.three_d_secure_results import ThreeDSecureResults
from onlinepayments.sdk.domain.three_d_secure_results import ThreeDSecureResults as ThreeDSecureResultsSdk

class ThreeDSecureResultsMapper:

    @staticmethod
    def map_from_sdk_response(response: Optional[ThreeDSecureResultsSdk]) -> Optional[ThreeDSecureResults]:
        if response is None:
            return None

        dto = ThreeDSecureResults()
        dto.acs_transaction_id = response.acs_transaction_id
        dto.applied_exemption = response.applied_exemption
        dto.authentication_status = response.authentication_status
        dto.cavv = response.cavv
        dto.challenge_indicator = response.challenge_indicator
        dto.ds_transaction_id = response.ds_transaction_id
        dto.eci = response.eci
        dto.exemption_engine_flow = response.exemption_engine_flow
        dto.flow = response.flow
        dto.liability = response.liability
        dto.scheme_eci = response.scheme_eci
        dto.version = response.version
        dto.xid = response.xid

        return dto