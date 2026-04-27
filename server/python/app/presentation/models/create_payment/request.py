from pydantic import BaseModel, field_validator, ConfigDict
from pydantic.alias_generators import to_camel
from typing import Optional
from app.application.dtos.common.address_dto import AddressDto
from app.application.domain.payments.card import Card
from app.application.domain.payments.mandate import Mandate

class CreatePaymentRequest(BaseModel):
    model_config = ConfigDict(alias_generator=to_camel, populate_by_name=True)

    amount: Optional[float] = None
    currency: Optional[str] = None
    method: Optional[str] = None
    hosted_tokenization_id: Optional[str] = None
    billing_address: Optional[AddressDto] = None
    shipping_address: Optional[AddressDto] = None
    card: Optional[Card] = None
    mandate: Optional[Mandate] = None

    @field_validator("amount", mode="before")
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