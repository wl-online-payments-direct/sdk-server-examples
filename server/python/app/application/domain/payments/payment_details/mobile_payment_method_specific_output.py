from dataclasses import dataclass
from typing import Optional

from app.application.domain.payments.payment_details.card_fraud_results import CardFraudResults
from app.application.domain.payments.payment_details.mobile_payment_data import MobilePaymentData
from app.application.domain.payments.payment_details.three_d_secure_results import ThreeDSecureResults

@dataclass
class MobilePaymentMethodSpecificOutput:
    authorisation_code: Optional[str] = None
    fraud_results: Optional[CardFraudResults] = None
    network: Optional[str] = None
    payment_data: Optional[MobilePaymentData] = None
    payment_product_id: Optional[int] = None
    three_d_secure_results: Optional[ThreeDSecureResults] = None