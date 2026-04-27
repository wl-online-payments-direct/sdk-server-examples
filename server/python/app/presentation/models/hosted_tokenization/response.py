from pydantic import BaseModel, ConfigDict
from pydantic.alias_generators import to_camel

class HostedTokenizationResponse(BaseModel):
    model_config = ConfigDict(alias_generator=to_camel, populate_by_name=True)

    hosted_tokenization_id: str
    hosted_tokenization_url: str