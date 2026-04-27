from dataclasses import dataclass
from typing import Optional
from app.application.domain.enums.common.currency import Currency
from app.application.domain.enums.payments.payment_method_type import PaymentMethodType
from app.application.domain.payments.card import Card
from app.application.domain.payments.mandate import Mandate
from app.application.dtos.common.address_dto import AddressDto

@dataclass
class CreatePaymentRequestDto:
    amount: Optional[int] = None
    currency: Optional[Currency] = None
    method: Optional[PaymentMethodType] = None
    hosted_tokenization_id: Optional[str] = None
    billing_address: Optional[AddressDto] = None
    shipping_address: Optional[AddressDto] = None
    card: Optional[Card] = None
    mandate: Optional[Mandate] = None
    payment_product_id: Optional[int] = None