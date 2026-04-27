from enum import Enum

class RecurrenceType(str, Enum):
    UNIQUE = "UNIQUE"
    RECURRING = "RECURRING"

    @classmethod
    def has_value(cls, value: str) -> bool:
        return value in cls._value2member_map_