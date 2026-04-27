from typing import Optional
from pydantic import BaseModel, ConfigDict
from pydantic.alias_generators import to_camel
from app.application.dtos.common.address_dto import AddressDto
from app.application.domain.enums.payments.recurrence_type import RecurrenceType
from app.application.domain.enums.payments.signature_type import SignatureType

class Mandate(BaseModel):
    model_config = ConfigDict(alias_generator=to_camel, populate_by_name=True)

    iban: Optional[str] = None
    customer_reference: Optional[str] = None
    mandate_reference: Optional[str] = None
    recurrence_type: Optional[RecurrenceType] = None
    signature_type: Optional[SignatureType] = None
    return_url: Optional[str] = None
    address: Optional[AddressDto] = None