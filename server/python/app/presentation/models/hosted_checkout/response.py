from pydantic import BaseModel, ConfigDict
from typing import Optional
from pydantic.alias_generators import to_camel

class HostedCheckoutResponse(BaseModel):
    model_config = ConfigDict(alias_generator=to_camel, populate_by_name=True)

    hosted_checkout_id: str
    redirect_url: str
    return_mac: Optional[str] = None
    amount: float
    currency: str