from pydantic import BaseModel, ConfigDict
from typing import Optional, List
from pydantic.alias_generators import to_camel
from app.application.domain.payments.payment_details.hosted_checkout_specific_output import HostedCheckoutSpecificOutput
from app.application.domain.payments.payment_details.operation_output import OperationOutput
from app.application.domain.payments.payment_details.payment_output import PaymentOutput
from app.application.domain.payments.payment_details.payment_status_output import PaymentStatusOutput

class GetPaymentDetailsResponse(BaseModel):
    model_config = ConfigDict(alias_generator=to_camel, populate_by_name=True)

    id: Optional[str] = None
    status: Optional[str] = None
    status_output: Optional[PaymentStatusOutput] = None
    payment_output: Optional[PaymentOutput] = None
    hosted_checkout_specific_output: Optional[HostedCheckoutSpecificOutput] = None
    operations: Optional[List[OperationOutput]] = None