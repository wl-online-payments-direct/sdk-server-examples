from typing import Optional
from app.application.domain.payments.payment_details.personal_name import PersonalName
from onlinepayments.sdk.domain.personal_name import PersonalName as PersonalNameSdk

class PersonalNameMapper:

    @staticmethod
    def map_from_sdk_response(response: Optional[PersonalNameSdk]) -> Optional[PersonalName]:
        if response is None:
            return None

        return PersonalName(
            first_name = response.first_name,
            surname = response.surname,
            title = response.title
        )