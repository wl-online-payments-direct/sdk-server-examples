from enum import Enum

class StatusCategory(str, Enum):
    CREATED = "CREATED"
    UNSUCCESSFUL = "UNSUCCESSFUL"
    PENDING_PAYMENT = "PENDING_PAYMENT"
    PENDING_MERCHANT = "PENDING_MERCHANT"
    PENDING_CONNECT_OR_3RD_PARTY = "PENDING_CONNECT_OR_3RD_PARTY"
    COMPLETED = "COMPLETED"
    REVERSED = "REVERSED"
    REFUNDED = "REFUNDED"

    @classmethod
    def try_from(cls, value: str):
        try:
            return cls(value.upper())
        except ValueError:
            return None