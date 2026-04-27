from typing import Optional
from app.application.domain.payments.payment_details.surcharge_specific_output import SurchargeSpecificOutput
from onlinepayments.sdk.domain.surcharge_specific_output import SurchargeSpecificOutput as SurchargeSpecificOutputSdk
from app.infrastructure.mappers.payment_details.surcharge_rate_mapper import SurchargeRateMapper
from app.infrastructure.mappers.payment_details.amount_of_money_mapper import AmountOfMoneyMapper

class SurchargeSpecificOutputMapper:

    @staticmethod
    def map_from_sdk_response(response: Optional[SurchargeSpecificOutputSdk]) -> Optional[SurchargeSpecificOutput]:
        if response is None:
            return None

        dto = SurchargeSpecificOutput()
        dto.surcharge_rate = SurchargeRateMapper.map_from_sdk_response(response.surcharge_rate)
        dto.surcharge_amount = AmountOfMoneyMapper.map_from_sdk_response(response.surcharge_amount)
        dto.mode = response.mode

        return dto