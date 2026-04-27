from dataclasses import dataclass
from typing import Optional

from app.application.domain.payments.payment_details.amount_of_money import AmountOfMoney
from app.application.domain.payments.payment_details.card_payment_method_specific_output import CardPaymentMethodSpecificOutput
from app.application.domain.payments.payment_details.customer_output import CustomerOutput
from app.application.domain.payments.payment_details.discount import Discount
from app.application.domain.payments.payment_details.mobile_payment_method_specific_output import MobilePaymentMethodSpecificOutput
from app.application.domain.payments.payment_details.payment_references import PaymentReferences
from app.application.domain.payments.payment_details.redirect_payment_method_specific_output import RedirectPaymentMethodSpecificOutput
from app.application.domain.payments.payment_details.sepa_direct_debit_payment_method_specific_output import SepaDirectDebitPaymentMethodSpecificOutput
from app.application.domain.payments.payment_details.surcharge_specific_output import SurchargeSpecificOutput

@dataclass
class PaymentOutput:
    amount_of_money: Optional[AmountOfMoney] = None
    references: Optional[PaymentReferences] = None
    acquired_amount: Optional[AmountOfMoney] = None
    customer: Optional[CustomerOutput] = None
    card_payment_method_specific_output: Optional[CardPaymentMethodSpecificOutput] = None
    payment_method: Optional[str] = None
    merchant_parameters: Optional[str] = None
    discount: Optional[Discount] = None
    surcharge_specific_output: Optional[SurchargeSpecificOutput] = None
    sepa_direct_debit_payment_method_specific_output: Optional[SepaDirectDebitPaymentMethodSpecificOutput] = None
    redirect_payment_method_specific_output: Optional[RedirectPaymentMethodSpecificOutput] = None
    mobile_payment_method_specific_output: Optional[MobilePaymentMethodSpecificOutput] = None