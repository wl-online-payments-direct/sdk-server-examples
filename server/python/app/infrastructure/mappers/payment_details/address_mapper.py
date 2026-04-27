from typing import Optional
from app.application.domain.payments.payment_details.address import Address
from onlinepayments.sdk.domain.address import Address as AddressSdk

class AddressMapper:

    @staticmethod
    def map_from_sdk_response(response: Optional[AddressSdk]) -> Optional[Address]:
        if response is None:
            return None

        dto = Address()
        dto.additional_info = response.additional_info
        dto.city = response.city
        dto.country_code = response.country_code
        dto.house_number = response.house_number
        dto.state = response.state
        dto.street = response.street
        dto.zip = response.zip

        return dto