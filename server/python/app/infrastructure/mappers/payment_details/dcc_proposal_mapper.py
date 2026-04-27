from typing import Optional
from app.application.domain.payments.payment_details.dcc_proposal import DccProposal
from app.infrastructure.mappers.payment_details.amount_of_money_mapper import AmountOfMoneyMapper
from app.infrastructure.mappers.payment_details.rate_details_mapper import RateDetailsMapper
from onlinepayments.sdk.domain.dcc_proposal import DccProposal as DccProposalSdk

class DccProposalMapper:

    @staticmethod
    def map_from_sdk_response(response: Optional[DccProposalSdk]) -> Optional[DccProposal]:
        if response is None:
            return None

        return DccProposal(
            rate = RateDetailsMapper.map_from_sdk_response(response.rate),
            base_amount = AmountOfMoneyMapper.map_from_sdk_response(response.base_amount),
            disclaimer_display = response.disclaimer_display,
            disclaimer_receipt = response.disclaimer_receipt,
            target_amount = AmountOfMoneyMapper.map_from_sdk_response(response.target_amount)
        )