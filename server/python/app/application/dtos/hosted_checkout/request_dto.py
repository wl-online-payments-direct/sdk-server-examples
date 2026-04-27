from dataclasses import dataclass
from typing import Optional
from app.application.domain.enums.common.currency import Currency
from app.application.domain.enums.common.language import Language
from app.application.dtos.common.address_dto import AddressDto

@dataclass
class CreateHostedCheckoutRequestDto:
    amount: Optional[int] = None
    currency: Optional[Currency] = None
    language: Optional[Language] = None
    billing_address: Optional[AddressDto] = None
    shipping_address: Optional[AddressDto] = None
    redirect_url: Optional[str] = None