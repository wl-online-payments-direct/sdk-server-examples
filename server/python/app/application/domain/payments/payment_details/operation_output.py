from dataclasses import dataclass
from typing import Optional

from app.application.domain.payments.payment_details.amount_of_money import AmountOfMoney
from app.application.domain.payments.payment_details.operation_payment_references import OperationPaymentReferences
from app.application.domain.payments.payment_details.payment_references import PaymentReferences
from app.application.domain.payments.payment_details.payment_status_output import PaymentStatusOutput

@dataclass
class OperationOutput:
    amount_of_money: Optional[AmountOfMoney] = None
    id: Optional[str] = None
    operation_references: Optional[OperationPaymentReferences] = None
    payment_method: Optional[str] = None
    references: Optional[PaymentReferences] = None
    status: Optional[str] = None
    status_output: Optional[PaymentStatusOutput] = None