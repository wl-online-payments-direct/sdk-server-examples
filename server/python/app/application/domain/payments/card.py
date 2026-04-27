from typing import Optional
from pydantic import BaseModel, ConfigDict
from pydantic.alias_generators import to_camel

class Card(BaseModel):
    model_config = ConfigDict(alias_generator=to_camel, populate_by_name=True)

    number: Optional[str] = None
    holder_name: Optional[str] = None
    verification_code: Optional[str] = None
    expiry_month: Optional[str] = None
    expiry_year: Optional[str] = None