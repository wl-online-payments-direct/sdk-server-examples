from typing import Optional
from app.application.domain.payments.payment_details.surcharge_rate import SurchargeRate
from onlinepayments.sdk.domain.surcharge_rate import SurchargeRate as SurchargeRateSdk

class SurchargeRateMapper:

    @staticmethod
    def map_from_sdk_response(response: Optional[SurchargeRateSdk]) -> Optional[SurchargeRate]:
        if response is None:
            return None

        dto = SurchargeRate()
        dto.specific_rate = response.specific_rate
        dto.ad_valorem_rate = response.ad_valorem_rate
        dto.surcharge_product_type_version = response.surcharge_product_type_version
        dto.surcharge_product_type_id = response.surcharge_product_type_id

        return dto