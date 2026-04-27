from typing import Optional
from app.application.domain.payments.payment_details.address_personal import AddressPersonal
from app.infrastructure.mappers.payment_details.personal_name_mapper import PersonalNameMapper
from onlinepayments.sdk.domain.address_personal import AddressPersonal as AddressPersonalSdk

class AddressPersonalMapper:

    @staticmethod
    def map_from_sdk_response(response: Optional[AddressPersonalSdk]) -> Optional[AddressPersonal]:
        if response is None:
            return None

        return AddressPersonal(
            additional_info = response.additional_info,
            city = response.city,
            company_name = response.company_name,
            country_code = response.country_code,
            house_number = response.house_number,
            name = PersonalNameMapper.map_from_sdk_response(response.name),
            state = response.state,
            street = response.street,
            zip = response.zip,
        )