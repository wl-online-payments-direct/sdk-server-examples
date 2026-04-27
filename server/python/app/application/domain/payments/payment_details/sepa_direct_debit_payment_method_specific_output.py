from dataclasses import dataclass
from typing import Optional

from app.application.domain.payments.payment_details.fraud_result import FraudResults
from app.application.domain.payments.payment_details.payment_product_771_specific_output import PaymentProduct771SpecificOutput

@dataclass
class SepaDirectDebitPaymentMethodSpecificOutput:
    fraud_results: Optional[FraudResults] = None
    payment_product_771_specific_output: Optional[PaymentProduct771SpecificOutput] = None
    payment_product_id: Optional[int] = None