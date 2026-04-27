from typing import Optional
from app.application.domain.payments.payment_details.currency_conversion import CurrencyConversion
from onlinepayments.sdk.domain.currency_conversion import CurrencyConversion as CurrencyConversionSdk
from app.infrastructure.mappers.payment_details.dcc_proposal_mapper import DccProposalMapper

class CurrencyConversionMapper:

    @staticmethod
    def map_from_sdk_response(response: Optional[CurrencyConversionSdk]) -> Optional[CurrencyConversion]:
        if response is None:
            return None

        return CurrencyConversion(
            accepted_by_user = response.accepted_by_user,
            proposal = DccProposalMapper.map_from_sdk_response(response.proposal)
        )