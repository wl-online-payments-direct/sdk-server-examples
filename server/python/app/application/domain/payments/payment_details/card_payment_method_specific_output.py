from dataclasses import dataclass
from typing import Optional, Any

from app.application.domain.payments.payment_details.acquirer_information import AcquirerInformation
from app.application.domain.payments.payment_details.card_essentials import CardEssentials
from app.application.domain.payments.payment_details.card_fraud_results import CardFraudResults
from app.application.domain.payments.payment_details.currency_conversion import CurrencyConversion
from app.application.domain.payments.payment_details.external_token_linked import ExternalTokenLinked
from app.application.domain.payments.payment_details.payment_product_3208_specific_output import PaymentProduct3208SpecificOutput
from app.application.domain.payments.payment_details.payment_product_3209_specific_output import PaymentProduct3209SpecificOutput
from app.application.domain.payments.payment_details.reattempt_instructions import ReattemptInstructions
from app.application.domain.payments.payment_details.three_d_secure_results import ThreeDSecureResults

@dataclass
class CardPaymentMethodSpecificOutput:
    acquirer_information: Optional[AcquirerInformation] = None
    authorisation_code: Optional[str] = None
    card: Optional[CardEssentials] = None
    fraud_results: Optional[CardFraudResults] = None
    payment_account_reference: Optional[str] = None
    payment_product_id: Optional[int] = None
    three_d_secure_results: Optional[ThreeDSecureResults] = None
    initial_scheme_transaction_id: Optional[str] = None
    scheme_reference_data: Optional[str] = None
    token: Optional[str] = None
    payment_option: Optional[str] = None
    external_token_linked: Optional[ExternalTokenLinked] = None
    authenticated_amount: Optional[int] = None
    currency_conversion: Optional[CurrencyConversion] = None
    payment_product_3208_specific_output: Optional[PaymentProduct3208SpecificOutput] = None
    payment_product_3209_specific_output: Optional[PaymentProduct3209SpecificOutput] = None
    reattempt_instructions: Optional[ReattemptInstructions] = None