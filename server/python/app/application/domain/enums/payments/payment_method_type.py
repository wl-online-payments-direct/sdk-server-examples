from enum import Enum

class PaymentMethodType(str, Enum):
    CREDIT_CARD = "CREDIT_CARD"
    TOKEN = "TOKEN"
    DIRECT_DEBIT = "DIRECT_DEBIT"

    @classmethod
    def has_value(cls, value: str) -> bool:
        return value in cls._value2member_map_

    @classmethod
    def try_from(cls, value: str):
        try:
            return cls(value.upper())
        except ValueError:
            return None