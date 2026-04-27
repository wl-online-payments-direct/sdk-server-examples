from pydantic import BaseModel, field_validator, ConfigDict
from typing import Optional
from pydantic.alias_generators import to_camel
from app.application.domain.enums.common.currency import Currency
from app.application.dtos.common.address_dto import AddressDto

class HostedCheckoutRequest(BaseModel):
    model_config = ConfigDict(alias_generator=to_camel, populate_by_name=True)

    amount: float
    currency: Currency
    language: Optional[str] = None
    redirect_url: Optional[str] = None
    billing_address: Optional[AddressDto] = None
    shipping_address: Optional[AddressDto] = None

    @field_validator('amount', mode='before')
    @classmethod
    def validate_amount(cls, v):
        if v is None:
            return v
        if isinstance(v, str) and v.strip() == "":
            return None
        try:
            return float(v)
        except (ValueError, TypeError):
            raise ValueError("The Amount field must be a number.")