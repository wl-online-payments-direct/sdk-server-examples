from dataclasses import dataclass
from typing import Optional

from app.application.domain.payments.payment_details.customer_bank_account import CustomerBankAccount
from app.application.domain.payments.payment_details.fraud_result import FraudResults
from app.application.domain.payments.payment_details.payment_product_3203_specific_output import PaymentProduct3203SpecificOutput
from app.application.domain.payments.payment_details.payment_product_5001_specific_output import PaymentProduct5001SpecificOutput
from app.application.domain.payments.payment_details.payment_product_5402_specific_output import PaymentProduct5402SpecificOutput
from app.application.domain.payments.payment_details.payment_product_5500_specific_output import PaymentProduct5500SpecificOutput
from app.application.domain.payments.payment_details.payment_product_840_specific_output import PaymentProduct840SpecificOutput

@dataclass
class RedirectPaymentMethodSpecificOutput:
    authorisation_code: Optional[str] = None
    customer_bank_account: Optional[CustomerBankAccount] = None
    fraud_results: Optional[FraudResults] = None
    payment_option: Optional[str] = None
    payment_product_3203_specific_output: Optional[PaymentProduct3203SpecificOutput] = None
    payment_product_5001_specific_output: Optional[PaymentProduct5001SpecificOutput] = None
    payment_product_5402_specific_output: Optional[PaymentProduct5402SpecificOutput] = None
    payment_product_5500_specific_output: Optional[PaymentProduct5500SpecificOutput] = None
    payment_product_840_specific_output: Optional[PaymentProduct840SpecificOutput] = None
    payment_product_id: Optional[int] = None
    token: Optional[str] = None