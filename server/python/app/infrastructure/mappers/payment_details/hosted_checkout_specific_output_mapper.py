from typing import Optional
from app.application.domain.payments.payment_details.hosted_checkout_specific_output import HostedCheckoutSpecificOutput
from onlinepayments.sdk.domain.hosted_checkout_specific_output import HostedCheckoutSpecificOutput as HostedCheckoutSpecificOutputSdk

class HostedCheckoutSpecificOutputMapper:

    @staticmethod
    def map_from_sdk_response(response: Optional[HostedCheckoutSpecificOutputSdk]) -> Optional[HostedCheckoutSpecificOutput]:
        if response is None:
            return None

        output = HostedCheckoutSpecificOutput()
        output.hosted_checkout_id = response.hosted_checkout_id
        output.variant = response.variant

        return output