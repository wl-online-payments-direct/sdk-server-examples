from enum import Enum

class Country(str, Enum):
    England = "England"
    France = "France"
    Germany = "Germany"

    @classmethod
    def has_value(cls, value: str) -> bool:
        return value in cls._value2member_map_

    @classmethod
    def to_iso_alpha2(cls, country: str) -> str:
        mapping = {
            "Germany": "DE",
            "France": "FR",
            "England": "GB"
        }

        return mapping.get(country, country)