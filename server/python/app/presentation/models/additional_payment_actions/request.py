from pydantic import BaseModel, field_validator, ConfigDict
from typing import Optional
from pydantic.alias_generators import to_camel

class AdditionalPaymentActionsRequest(BaseModel):
    model_config = ConfigDict(alias_generator=to_camel, populate_by_name=True)

    amount: Optional[float] = None
    currency: Optional[str] = None
    is_final: Optional[bool] = None

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