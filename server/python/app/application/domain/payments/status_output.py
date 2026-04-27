from typing import Optional
from pydantic import BaseModel, ConfigDict
from pydantic.alias_generators import to_camel

class StatusOutput(BaseModel):
    model_config = ConfigDict(alias_generator=to_camel, populate_by_name=True)

    status_code: Optional[int] = None
    status_category: Optional[str] = None