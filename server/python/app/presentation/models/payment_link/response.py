from pydantic import BaseModel, ConfigDict
from typing import Optional
from pydantic.alias_generators import to_camel

class PaymentLinkResponse(BaseModel):
    model_config = ConfigDict(alias_generator=to_camel, populate_by_name=True)

    payment_link_id: str
    redirect_url: str
    status: Optional[str] = None
    amount: Optional[float] = None
    currency: Optional[str] = None