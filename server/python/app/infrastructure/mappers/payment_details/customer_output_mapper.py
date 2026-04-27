from typing import Optional
from app.application.domain.payments.payment_details.customer_output import CustomerOutput
from app.infrastructure.mappers.payment_details.customer_device_output_mapper import CustomerDeviceOutputMapper
from onlinepayments.sdk.domain.customer_output import CustomerOutput as CustomerOutputSdk

class CustomerOutputMapper:

    @staticmethod
    def map_from_sdk_response(response: Optional[CustomerOutputSdk]) -> Optional[CustomerOutput]:
        if response is None:
            return None

        return CustomerOutput(
            device = CustomerDeviceOutputMapper.map_from_sdk_response(response.device)
        )