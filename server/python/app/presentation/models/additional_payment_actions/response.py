from pydantic import BaseModel, ConfigDict
from typing import Optional
from pydantic.alias_generators import to_camel

class AdditionalPaymentActionsResponse(BaseModel):
    model_config = ConfigDict(alias_generator=to_camel, populate_by_name=True)

    id: Optional[str] = None
    status: Optional[str] = None
    status_output: Optional[dict] = None