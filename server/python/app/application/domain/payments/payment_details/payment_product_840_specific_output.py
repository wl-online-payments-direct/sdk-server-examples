from dataclasses import dataclass
from typing import Optional

from app.application.domain.payments.payment_details.address import Address
from app.application.domain.payments.payment_details.payment_product_840_customer_account import PaymentProduct840CustomerAccount
from app.application.domain.payments.payment_details.protection_eligibility import ProtectionEligibility

@dataclass
class PaymentProduct840SpecificOutput:
    billing_address: Optional[Address] = None
    customer_account: Optional[PaymentProduct840CustomerAccount] = None
    customer_address: Optional[Address] = None
    protection_eligibility: Optional[ProtectionEligibility] = None