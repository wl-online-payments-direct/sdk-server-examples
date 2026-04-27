from enum import Enum

class Currency(str, Enum):
    EUR = "EUR"
    USD = "USD"

    @classmethod
    def has_value(cls, value: str) -> bool:
        return value in cls._value2member_map_

    def to_currency(self) -> str:
        currency_map = {
            Currency.EUR: "EUR",
            Currency.USD: "USD"
        }
        
        return currency_map[self]