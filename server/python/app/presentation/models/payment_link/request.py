from pydantic import BaseModel, field_validator, ConfigDict
from typing import Optional
from pydantic.alias_generators import to_camel

class PaymentLinkRequest(BaseModel):
    model_config = ConfigDict(alias_generator=to_camel, populate_by_name=True)

    amount: float
    currency: str
    description: Optional[str] = None
    valid_for: Optional[int] = None
    action: Optional[str] = None

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

    @field_validator('valid_for', mode='before')
    @classmethod
    def validate_valid_for(cls, v):
        if v is None:
            return v
        try:
            return float(v)
        except (ValueError, TypeError):
            raise ValueError("The ValidFor field is invalid.")