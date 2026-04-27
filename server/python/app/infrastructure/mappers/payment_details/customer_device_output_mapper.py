from typing import Optional
from app.application.domain.payments.payment_details.customer_device_output import CustomerDeviceOutput
from onlinepayments.sdk.domain.customer_device_output import CustomerDeviceOutput as CustomerDeviceOutputSdk

class CustomerDeviceOutputMapper:

    @staticmethod
    def map_from_sdk_response(response: Optional[CustomerDeviceOutputSdk]) -> Optional[CustomerDeviceOutput]:
        if response is None:
            return None

        return CustomerDeviceOutput(
            ip_address_country_code = response.ip_address_country_code
        )