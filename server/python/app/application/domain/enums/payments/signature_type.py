from enum import Enum

class SignatureType(str, Enum):
    SMS = "SMS"
    UNSIGNED = "UNSIGNED"
    TICK_BOX = "TICK_BOX"

    @classmethod
    def has_value(cls, value: str) -> bool:
        return value in cls._value2member_map_